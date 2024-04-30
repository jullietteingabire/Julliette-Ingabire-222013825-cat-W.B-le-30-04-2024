<?php

include('database_connection.php');

// Initialize $Flower_id variable and $row
$Flower_id = null;
$row = [];

// Check if form is submitted for update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $Flower_id = $_POST['Flower_id']; // Get $Flower_id from hidden input
    $Flower_type = $_POST['Flower_type'];
    $Unit_price = $_POST['Unit_price'];
    $Quantity = $_POST['Quantity'];
   
    // Prepare and execute the UPDATE statement using prepared statement
    $stmt = $conn->prepare("UPDATE flower SET Flower_type=?, Unit_price=?, Quantity=? WHERE Flower_id=?");
    $stmt->bind_param("sssi", $Flower_type, $Unit_price, $Quantity, $Flower_id);
    if ($stmt->execute()) {
        header('Location: flower.php?msg=Record updated successfully');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing data for the selected ID
if (isset($_GET['updateFlower_id'])) {
    $Flower_id = $_GET['updateFlower_id'];
    // Prepare statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM flower WHERE Flower_id=?");
    $stmt->bind_param("i", $Flower_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found for ID: $Flower_id";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update flower</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
    <!-- Update flower form -->
    
    <form method="POST" onsubmit="return confirmUpdate();">
       
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        
        <form method="POST" action="">
            <!DOCTYPE html>
<html>
<head>
    <title>Update flower</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <h2><u>Update Form of flower</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
            <input type="hidden" name="Flower_id" value="<?php echo $Flower_id; ?>">
            
            <div class="form-group">
                <label for="Flower_type">Flower Type:</label>
                <input type="text" id="Flower_type" name="Flower_type" value="<?php echo isset($row['Flower_type']) ? $row['Flower_type'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="Unit_price">Unit Price:</label>
                <input type="number" id="Unit_price" name="Unit_price" value="<?php echo isset($row['Unit_price']) ? $row['Unit_price'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="Quantity">Quantity:</label>
                <input type="number" id="Quantity" name="Quantity" value="<?php echo isset($row['Quantity']) ? $row['Quantity'] : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <input type="submit" name="submit" value="Update" class="btn btn-primary">
                <a href="flower.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
