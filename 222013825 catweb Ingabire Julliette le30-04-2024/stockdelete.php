<?php
// Include database connection
include('database_connection.php');

// Check if Stock_id is set and is numeric
if(isset($_GET['deleteStock_id']) && is_numeric($_GET['deleteStock_id'])) {
    $Stock_id = $_GET['deleteStock_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM stock WHERE Stock_id=?");
    
    if ($stmt) {
        $stmt->bind_param("i", $Stock_id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="deleteStock_id" value="<?php echo $Stock_id; ?>">
        <input type="submit" value="Delete">
    </form>
</body>
</html>
<?php
        // Close the HTML section before PHP execution

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
                // Redirect with success message
                header('Location: stock.php?msg=Record deleted successfully');
                exit(); // Ensure the script stops executing after redirection
            } else {
                echo "Error executing delete operation: " . $stmt->error;
            }
        }

        $stmt->close();
    } else {
        echo "Error preparing delete statement: " . $conn->error;
    }
} else {
    echo "Invalid or missing stock ID.";
}

$conn->close();
?>
