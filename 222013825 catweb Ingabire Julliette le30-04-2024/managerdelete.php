<?php
// Connection details
include('database_connection.php');

// Check if Manager_id is set and is numeric
if(isset($_GET['deleteManager_id']) && is_numeric($_GET['deleteManager_id'])) {
    $Manager_id = $_GET['deleteManager_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM manager WHERE Manager_id=?");

    if ($stmt) {
        $stmt->bind_param("i", $Manager_id);
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
                <input type="hidden" name="Manager_id" value="<?php echo $Manager_id; ?>">
                <input type="submit" value="Delete">
            </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
                // Redirect with success message
                header('Location: manager.php?msg=Record deleted successfully');
                exit(); // Ensure the script stops executing after redirection
            } else {
                echo "Error executing delete operation: " . $stmt->error;
            }
        }
        ?>

        </body>
        </html>
        <?php

        $stmt->close();
    } else {
        echo "Error preparing delete statement: " . $conn->error;
    }
} else {
    echo "Invalid or missing Manager ID.";
}

$conn->close();
?>
