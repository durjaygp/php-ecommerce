<?php
// Connect to the database
$connection = mysqli_connect('localhost', 'root', '', 'test_ajax_php');
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if a category_id is provided in the request
if (isset($_GET['category_id'])) {
    $category_id = mysqli_real_escape_string($connection, $_GET['category_id']);

    // Fetch brands for the selected category from the database
    $query = "SELECT * FROM brands WHERE category_id = $category_id";
    $result = mysqli_query($connection, $query);
    $brands = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $brands[] = $row;
    }

    // Return brands as JSON
    header('Content-Type: application/json');
    echo json_encode($brands);
} else {
    // If no category_id is provided, return an empty array
    header('Content-Type: application/json');
    echo json_encode([]);
}
?>
