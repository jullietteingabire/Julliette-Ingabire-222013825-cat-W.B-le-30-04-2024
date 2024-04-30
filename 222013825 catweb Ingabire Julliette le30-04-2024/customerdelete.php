<?php
// Connection details
include('database_connection.php');

// Check if Customer_id is set
if(isset($_REQUEST['deleteCustomer_id'])) {
    $customer_id = $_REQUEST['deleteCustomer_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM customers WHERE Customer_id=?");

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
            <input type="hidden" name="deleteCustomer_id" value="<?php echo $customer_id; ?>">
            <input type="submit" value="Delete">
        </form>
    </body>
    </html>
    <?php

    // Close the HTML section before PHP execution

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $stmt->bind_param("i", $customer_id);
        if ($stmt->execute()) {
            // Redirect with success message
            header('Location: customer.php?msg=Record deleted successfully');
            exit(); // Ensure the script stops executing after redirection
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
    }

    $stmt->close();
} else {
    echo "Customer_id is not set.";
}

$conn->close();
?>
