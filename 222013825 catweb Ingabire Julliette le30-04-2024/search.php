<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {
    // Connection details 
    include('database_connection.php');

   
    // Check connection
    if ($conn->conn_error) {
        die("Conn failed: " . $conn->conn_error);
    }

    // Sanitize input to prevent SQL injection
    $searchTerm = $conn->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'customer' => "SELECT Customername FROM customers WHERE Customername LIKE '%$searchTerm%'",
        'payment' => "SELECT PaymentMethod FROM payment WHERE PaymentMethod LIKE '%$searchTerm%'",
        'supplier' => " SELECT SupplierName FROM supplier WHERE SupplierName LIKE '%$searchTerm%'",
        'stock' => "SELECT  ProductName FROM stock WHERE ProductName LIKE '%$searchTerm%'",
        'manager' => "SELECT Manager_name FROM manager WHERE Manager_name LIKE '%$searchTerm%'",
        'flower' => "SELECT Flower_type FROM flower WHERE Flower_type LIKE '%$searchTerm%'",
        
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $conn->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
   $conn->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
