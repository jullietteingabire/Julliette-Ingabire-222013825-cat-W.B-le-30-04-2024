<?php
// Connection
$host = "localhost";
$user = "ingabire";
$pass = "222013825";
$database = "flowers_management_system";

// Create the connection
$conn = new mysqli($host, $user, $pass, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>