<?php
include('database_connection.php');

// Initialize $Stock_id variable
$Stock_id = null;

// Check if $Stock_id is set and form is submitted
if (isset($_GET['updateStock_id']) && isset($_POST['submit'])) {
    $Stock_id = $_POST['Stock_id']; // Get $Stock_id from hidden input
    $ProductName = $_POST['ProductName'];
    $UnitPrice = $_POST['UnitPrice'];
    $DateReceived = $_POST['DateReceived'];
    $QuantityAvailable = $_POST['QuantityAvailable'];
    $Flower_id = $_POST['Flower_id'];
    
    // Prepare and execute the UPDATE statement
    $stmt = $conn->prepare("UPDATE stock SET ProductName=?, UnitPrice=?, DateReceived=?, QuantityAvailable=?, Flower_id=? WHERE Stock_id=?");
    $stmt->bind_param("ssssii", $ProductName, $UnitPrice, $DateReceived, $QuantityAvailable, $Flower_id, $Stock_id);

    if ($stmt->execute()) {
        header('Location: stock.php?msg=Record updated successfully');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing data for the selected ID
if (isset($_GET['updateStock_id'])) {
    $Stock_id = $_GET['updateStock_id'];
    $sql_select = "SELECT * FROM stock WHERE Stock_id=$Stock_id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found for ID: $Stock_id";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update stock</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
   
    <form method="POST" onsubmit="return confirmUpdate();">
        <h2>Update stock form</h2>
        <form method="POST" action="">
            <input type="hidden" name="Stock_id" value="
            <?php echo $Stock_id; ?>">
            
            <div class="form-group">
                <label for="ProductName">ProductName:</label>
                <input type="text" id="ProductName" name="ProductName" value="<?php echo isset($row['ProductName']) ? $row['ProductName'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="UnitPrice">UnitPrice:</label>
                <input type="number" id="UnitPrice" name="UnitPrice" value="<?php echo isset($row['UnitPrice']) ? $row['UnitPrice'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="DateReceived">DateReceived:</label>
                <input type="date" id="DateReceived" name="DateReceived" value="<?php echo isset($row['DateReceived']) ? $row['DateReceived'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="QuantityAvailable">QuantityAvailable:</label>
                <input type="number" id="QuantityAvailable" name="QuantityAvailable" value="<?php echo isset($row['QuantityAvailable']) ? $row['QuantityAvailable'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="Flower_id">Flower_id:</label>
                <input type="number" id="Flower_id" name="Flower_id" value="<?php echo isset($row['Flower_id']) ? $row['Flower_id'] : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <input type="submit" name="submit" value="Update" class="btn btn-primary">
                <a href="stock.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
