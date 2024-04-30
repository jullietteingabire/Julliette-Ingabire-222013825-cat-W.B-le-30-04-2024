<?php
include('database_connection.php');

// Initialize $Supplier_id variable
$Supplier_id = null;

// Check if $Supplier_id is set and form is submitted
if (isset($_GET['updateSupplier_id']) && isset($_POST['submit'])) {
    $Supplier_id = $_POST['Supplier_id']; // Get $Supplier_id from hidden input
    $SupplierName = $_POST['SupplierName'];
    $Telephone = $_POST['Telephone'];
    $Email = $_POST['Email'];
    $Address = $_POST['Address'];
    $Gender = $_POST['Gender'];
    $Manager_id = $_POST['Manager_id'];
    
    // Prepare and execute the UPDATE statement
    $stmt = $conn->prepare("UPDATE supplier SET SupplierName=?, Telephone=?, Email=?, Address=?, Gender=?, Manager_id=? WHERE Supplier_id=?");
    $stmt->bind_param("sssssii", $SupplierName, $Telephone, $Email, $Address, $Gender, $Manager_id, $Supplier_id);

    if ($stmt->execute()) {
        header('Location: supplier.php?msg=Record updated successfully');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing data for the selected ID
if (isset($_GET['updateSupplier_id'])) {
    $Supplier_id = $_GET['updateSupplier_id'];
    $sql_select = "SELECT * FROM supplier WHERE Supplier_id=$Supplier_id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found for ID: $Supplier_id";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update supplier</title>
    <!-- JavaScript validation and content load for update or modify data -->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <h2>Update supplier form</h2>
        <form method="POST" action="" onsubmit="return confirmUpdate();">
            <input type="hidden" name="Supplier_id" value="<?php echo $Supplier_id; ?>">
            
            <div class="form-group">
                <label for="SupplierName">SupplierName:</label>
                <input type="text" id="SupplierName" name="SupplierName" value="<?php echo isset($row['SupplierName']) ? $row['SupplierName'] : ''; ?>" required>
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
                <label for="Address">Address:</label>
                <input type="text" id="Address" name="Address" value="<?php echo isset($row['Address']) ? $row['Address'] : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="Gender">Gender:</label>
                <select id="Gender" name="Gender" required>
                    <option value="male" <?php echo (isset($row['Gender']) && $row['Gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                    <option value="female" <?php echo (isset($row['Gender']) && $row['Gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Manager_id">Manager_id:</label>
                <input type="number" id="Manager_id" name="Manager_id" value="<?php echo isset($row['Manager_id']) ? $row['Manager_id'] : ''; ?>" required>
            </div>

            <div class="form-group">
                <input type="submit" name="submit" value="Update" class="btn btn-primary">
                <a href="manager.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </center>
</body>
</html>
