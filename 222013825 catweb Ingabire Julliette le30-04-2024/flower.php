<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Category</title>

  <style>
  .dropdown {
    position: relative;
    display: inline;
    margin-right: 10px;
  }
  .dropdown-contents {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    left: 0; /* Aligning dropdown contents to the left */
  }
  .dropdown:hover .dropdown-contents {
    display: block;
  }
  .dropdown-contents a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }
  .dropdown-contents a:hover {
    background-color: #f1f1f1;
  }
  header{
    background-color:skyblue;
    padding:20px;
    margin-top: 0px;
    
}
section{
    padding:90px;
    border-bottom: 0px solid #ddd;
}
* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1100px; /* Adjust this value as needed */

      padding: 8px;
}


</style>
<!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
</head>
<header>
<body bgcolor="grey" >

<!-- <div class="col-3 offset">-->
    
  <form class="d-flex" role="search" action="search.php" >
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"name="query" >  >
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>



  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;"><a href="./home.html" style="padding: 10px; color: white; background-color:hotpink; text-decoration: none; margin-right: 15px;">Home</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./About us.html" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">About us</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Contact us.html" style="padding: 9.5px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">Contact us</a></li>


    <li style="display: inline; margin-right: 10px;"><a href="./customer.php" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">customer</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./payment.php" style="padding: 9.5px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">payment</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./supplier.php" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">supplier</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./stock.php" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">stock</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./manager.php" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">manager</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./flower.php" style="padding: 10px; color: white; background-color:hotpink; text-decoration: none; margin-right: 15px;">flower</a></li>
    
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: hotpink; background-color:aliceblue; text-decoration: none; margin-right: 15px;">Setting</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li>
  </ul>
  </header>
<center>
<h5> FLOWER INFORMATION</h5>
<form method="post" onsubmit="return confirmInsert();">
<form method="POST" style="background-color: orange; align-items: center; width: 300px; height: 260px;"> <br><br><br>
        <label>Enter Flower_id:</label><br>
        <input type="number" name="Flower_id" required><br>
        <label>Enter Flower_type:</label><br>
        <input type="text" name="Flower_type" required><br>
        <label>Enter Unit_price:</label><br>
        <input type="number" name="Unit_price" required><br>
        <label>Enter Quantity:</label><br>
        <input type="number" name="Quantity" required><br>
       


<input type="submit" name="submit" Value="INSERT" > 
<input type="reset" name="" Value="cancel" > 
</form>
</center>
</body>
</html>
</body>
</html>




<?php
// Connection
include('database_connection.php');

// Insert data if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $conn->prepare("INSERT INTO flower (Flower_id,Flower_type,Unit_price,Quantity) VALUES (?, ?, ?, ? )");
    $stmt->bind_param("ssss",$Flower_id, $Flower_type, $Unit_price, $Quantity);

    // Set parameters and execute
    $Flower_id= $_POST['Flower_id'];
    $Flower_type = $_POST['Flower_type'];
    $Unit_price = $_POST['Unit_price'];
    $Quantity = $_POST['Quantity'];
    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Select data from the table
$sql = "SELECT * FROM flower";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of flower</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>TABLE OF FLOWER DATA</h2>
    
    <table id="dataTable">
        <tr>
            <th>Flower_id</th>
            <th>Flower_type</th>
            <th>Unit_price</th>
            <th>Quantity</th>
            <th>UPDATE</th>
            <th>DELETE</th>
        </tr>
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Flower_id"] .
                     "</td><td>" . $row["Flower_type"] .
                     "</td><td>" . $row["Unit_price"] .
                     "</td><td>" . $row["Quantity"] .
                     "</td><td><a href='flowerupdate.php?updateFlower_id=". $row['Flower_id']."'>UPDATE</a></td><td><a href='flowerdelete.php?deleteFlower_id=".$row['Flower_id']."'>DELETE</a></td></tr>";       
            }
        } else {
            echo "<tr><td colspan='4'>No data found</td></tr>";
        }
        ?>

    </table>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
<footer>
  <center> 
     <b><h2>UR CBE BIT &copy; 2024 &reg; Designer by:@JULLIETTE Ingabire</h2></b>
  </center>
</footer>
</p>
  
</body>
</html>
