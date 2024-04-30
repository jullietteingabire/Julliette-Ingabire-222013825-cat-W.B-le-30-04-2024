<?php
// Include database connection
include('database_connection.php');

// Check if Supplier_id is set and is numeric
if(isset($_GET['deleteSupplier_id']) && is_numeric($_GET['deleteSupplier_id'])) {
    $Supplier_id = $_GET['deleteSupplier_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM supplier WHERE Supplier_id=?");
    
    if ($stmt) {
        $stmt->bind_param("i", $Supplier_id);
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
        <input type="hidden" name="deleteSupplier_id" value="<?php echo $Supplier_id; ?>">
        <input type="submit" value="Delete">
    </form>
</body>
</html>
<?php
        // Close the HTML section before PHP execution

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
                // Redirect with success message
                header('Location: supplier.php?msg=Record deleted successfully');
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
    echo "Invalid or missing supplier ID.";
}

$conn->close();
?>
