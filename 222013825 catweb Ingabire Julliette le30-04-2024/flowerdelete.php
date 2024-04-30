<?php
// Connection details
include('database_connection.php');

// Check if Flower_id is set
if(isset($_REQUEST['deleteFlower_id'])) {
    $Flower_id = $_REQUEST['deleteFlower_id'];
    
    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM flower WHERE Flower_id=?");
    
    // Check if the statement is prepared successfully
    if ($stmt) {
        $stmt->bind_param("i", $Flower_id);
        
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Execute the statement
            if ($stmt->execute()) {
                // Redirect to flower.php after successful deletion
                header('Location: flower.php?msg=Record deleted successfully');
                exit(); // Ensure the script stops executing after redirection
            } else {
                // Print error message if execution fails
                echo "Error deleting data: " . $stmt->error;
            }
        }
        
        // Close the statement
        $stmt->close();
    } else {
        // Print error message if preparation fails
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    // Print message if Flower_id is not set
    echo "Flower_id is not set.";
}

// Close the database connection
$conn->close();
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
    <?php
    // Display the form only if Flower_id is set
    if(isset($_REQUEST['deleteFlower_id'])) {
        ?>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="deleteFlower_id" value="<?php echo htmlspecialchars($_REQUEST['deleteFlower_id']); ?>">
            <input type="submit" value="Delete">
        </form>
    <?php } ?>
</body>
</html>
