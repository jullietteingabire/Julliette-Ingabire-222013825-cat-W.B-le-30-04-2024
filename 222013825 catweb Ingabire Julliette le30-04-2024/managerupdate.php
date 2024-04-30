<?php
include('database_connection.php');

// Initialize $Manager_id variable
$Manager_id = null;

// Check if $Manager_id is set and form is submitted
if (isset($_GET['updateManager_id']) && isset($_POST['submit'])) {
    $Manager_id = $_POST['Manager_id']; // Get $Manager_id from hidden input
    $Manager_name = $_POST['Manager_name'];
    $username = $_POST['username'];
    $Telephone = $_POST['Telephone'];
    $Email = $_POST['Email'];
    $Customer_id = $_POST['Customer_id'];
    
    // Prepare and execute the UPDATE statement
    $stmt = $conn->prepare("UPDATE manager SET Manager_name=?, username=?, Telephone=?, Email=?, Customer_id=? WHERE Manager_id=?");
    $stmt->bind_param("ssssii", $Manager_name, $username, $Telephone, $Email, $Customer_id, $Manager_id);

    if ($stmt->execute()) {
        header('Location: manager.php?msg=Record updated successfully');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing data for the selected ID
if (isset($_GET['updateManager_id'])) {
    $Manager_id = $_GET['updateManager_id'];
    $sql_select = "SELECT * FROM manager WHERE Manager_id=$Manager_id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found for ID: $Manager_id";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update manager</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update manager form -->
    <form method="POST" onsubmit="return confirmUpdate();">
        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <h2>Update Manager manager</h2>
        <form method="POST" action="">
            <input type="hidden" name="Manager_id" value="<?php echo $Manager_id; ?>">
            
            <div class="form-group">
                <label for="Manager_name">Manager Name:</label>
                <input type="text" id="Manager_name" name="Manager_name" value="<?php echo isset($row['Manager_name']) ? $row['Manager_name'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo isset($row['username']) ? $row['username'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="Telephone">Telephone:</label>
                <input type="tel" id="Telephone" name="Telephone" value="<?php echo isset($row['Telephone']) ? $row['Telephone'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="Email">Email:</label>
                <input type="email" id="Email" name="Email" value="<?php echo isset($row['Email']) ? $row['Email'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="Customer_id">Customer ID:</label>
                <input type="number" id="Customer_id" name="Customer_id" value="<?php echo isset($row['Customer_id']) ? $row['Customer_id'] : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <input type="submit" name="submit" value="Update" class="btn btn-primary">
                <a href="manager.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
