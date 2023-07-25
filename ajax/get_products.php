<?php
// Connect to the database
$connection = mysqli_connect('localhost', 'root', '', 'test_ajax_php');
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if a brand_id is provided in the request
if (isset($_GET['brand_id'])) {
    $brand_id = mysqli_real_escape_string($connection, $_GET['brand_id']);

    // Fetch products for the selected brand from the database
    $query = "SELECT * FROM products WHERE brand_id = $brand_id";
    $result = mysqli_query($connection, $query);
    $products = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    // Return products as JSON
    header('Content-Type: application/json');
    echo json_encode($products);
} else {
    // If no brand_id is provided, return an empty array
    header('Content-Type: application/json');
    echo json_encode([]);
}
?>
