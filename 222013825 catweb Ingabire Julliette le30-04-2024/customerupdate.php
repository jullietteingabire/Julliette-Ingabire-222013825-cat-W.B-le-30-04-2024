<?php

include('database_connection.php');

// Initialize $customer_id variable
$customer_id = null;

// Check if $customer_id is set and form is submitted
if (isset($_GET['updateCustomer_id']) && isset($_POST['submit'])) {
    $customer_id = $_POST['Customer_id']; // Get $customer_id from hidden input
    $Customername = $_POST['Customername'];
    $Email = $_POST['Email'];
    $Address = $_POST['Address'];
    $Gender = $_POST['Gender'];
    
    // Prepare and execute the UPDATE statement
    $stmt = $conn->prepare("UPDATE customers SET Customername=?, Email=?, Address=?, Gender=? WHERE Customer_id=?");
    $stmt->bind_param("ssssi", $Customername, $Email, $Address, $Gender, $customer_id);

    if ($stmt->execute()) {
        header('Location: customer.php?msg=Record updated successfully');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing data for the selected ID
if (isset($_GET['updateCustomer_id'])) {
    $customer_id = $_GET['updateCustomer_id'];
    $sql_select = "SELECT * FROM customers WHERE Customer_id=$customer_id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found for ID: $customer_id";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update customers</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <h2>Update customer form</h2>
        <form method="POST" action="" onsubmit="return confirmUpdate();">
            <input type="hidden" name="Customer_id" value="<?php echo $customer_id; ?>">
            
            <div class="form-group">
                <label for="Customername">Customername:</label>
                <input type="text" id="Customername" name="Customername" value="<?php echo isset($row['Customername']) ? $row['Customername'] : ''; ?>" required>
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
                    <option value="male" <?php echo (isset($row['Gender']) && $row['Gender'] == 'male') ? 'selected' : ''; ?>>male</option>
                    <option value="female" <?php echo (isset($row['Gender']) && $row['Gender'] == 'female') ? 'selected' : ''; ?>>female</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Update" class="btn btn-primary">
                <a href="customer.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
