<?php
include('database_connection.php');

// Initialize $Payment_id variable
$Payment_id = null;

// Check if $Payment_id is set and form is submitted
if (isset($_GET['updatePayment_id']) && isset($_POST['submit'])) {
    $Payment_id = $_POST['Payment_id']; // Get $Payment_id from hidden input
    $Amaunt = $_POST['Amaunt'];
    $PaymentDate = $_POST['PaymentDate'];
    $PaymentMethod = $_POST['PaymentMethod'];
    $Customer_id = $_POST['Customer_id'];

    // Prepare and execute the UPDATE statement
    $stmt = $conn->prepare("UPDATE payment SET Amaunt=?, PaymentDate=?, PaymentMethod=?, Customer_id=? WHERE Payment_id=?");
    $stmt->bind_param("dsssi", $Amaunt, $PaymentDate, $PaymentMethod, $Customer_id, $Payment_id);

    if ($stmt->execute()) {
        header('Location: payment.php?msg=Record updated successfully');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing data for the selected ID
if (isset($_GET['updatePayment_id'])) {
    $Payment_id = $_GET['updatePayment_id'];
    $sql_select = "SELECT * FROM payment WHERE Payment_id=?";
    $stmt = $conn->prepare($sql_select);
    $stmt->bind_param("i", $Payment_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found for ID: $Payment_id";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update paymenta</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <form method="POST" onsubmit="return confirmUpdate();">
        <?php


        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <h2>Update Payment form</h2>
        <form method="POST" action="">
            <input type="hidden" name="Payment_id" value="<?php echo $Payment_id; ?>">
            
            <div class="form-group">
                <label for="Amaunt">Amount:</label>
                <input type="number" id="Amaunt" name="Amaunt" value="<?php echo isset($row['Amaunt']) ? $row['Amaunt'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="PaymentDate">Payment Date:</label>
                <input type="date" id="PaymentDate" name="PaymentDate" value="<?php echo isset($row['PaymentDate']) ? $row['PaymentDate'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="PaymentMethod">Payment Method:</label>
                <input type="text" id="PaymentMethod" name="PaymentMethod" value="<?php echo isset($row['PaymentMethod']) ? $row['PaymentMethod'] : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="Customer_id">Customer ID:</label>
                <input type="number" id="Customer_id" name="Customer_id" value="<?php echo isset($row['Customer_id']) ? $row['Customer_id'] : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <input type="submit" name="submit" value="Update" class="btn btn-primary">
                <a href="payment.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
