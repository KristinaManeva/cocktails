<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'DSR';

// Create and return the connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection and handle error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
