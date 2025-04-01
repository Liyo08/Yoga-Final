<?php

$host = "localhost";
$user = "root";  
$pass = "leo@20082068";  
$dbname = "zenfit_auth";  
$port = 3306;  // If your MySQL runs on a different port (e.g., 3307), change this

$conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
