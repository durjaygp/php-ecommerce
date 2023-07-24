<?php
// Initialize the session
session_start();

// Include database configuration
$host = "localhost"; // Change this to your MySQL host
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "live_react"; // Change this to your database name

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->close();

?>