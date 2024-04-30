<?php
// Connection details
include('database_connection.php');

// Check if Payment_id is set and is numeric
if(isset($_GET['deletePayment_id']) && is_numeric($_GET['deletePayment_id'])) {
    $Payment_id = $_GET['deletePayment_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM payment WHERE Payment_id=?");
    
    if ($stmt) {
        $stmt->bind_param("i", $Payment_id);
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
        <input type="hidden" name="deletePayment_id" value="<?php echo $Payment_id; ?>">
        <input type="submit" value="Delete">
    </form>
</body>
</html>
<?php
        // Close the HTML section before PHP execution

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
                // Redirect with success message
                header('Location: payment.php?msg=Record deleted successfully');
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
    echo "Invalid or missing payment ID.";
}

$conn->close();
?>
