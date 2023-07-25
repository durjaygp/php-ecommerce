<?php
// Connect to the database (replace 'your_host', 'your_username', 'your_password', and 'your_dbname' with your database credentials)
$connection = mysqli_connect('localhost', 'root', '', 'test_ajax_php');
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch categories from the database
$query = "SELECT * FROM categories";
$result = mysqli_query($connection, $query);
$categories = array();
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}

// Return categories as JSON
header('Content-Type: application/json');
echo json_encode($categories);
?>
