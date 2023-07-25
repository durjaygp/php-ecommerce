<?php
// Connect to the database (replace 'your_host', 'your_username', 'your_password', and 'your_dbname' with your database credentials)
$connection = mysqli_connect('your_host', 'your_username', 'your_password', 'your_dbname');
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the order request
    $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);
    $quantity = mysqli_real_escape_string($connection, $_POST['quantity']);

    // Fetch the product price from the database
    $query = "SELECT product_price FROM products WHERE id = $product_id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $product_price = $row['product_price'];

    // Calculate the total price
    $total_price = $quantity * $product_price;

    // Insert the order into the orders table
    $insert_query = "INSERT INTO orders (product_id, quantity, total_price) VALUES ($product_id, $quantity, $total_price)";
    if (mysqli_query($connection, $insert_query)) {
        // Order placed successfully
        echo "Order placed successfully!";
    } else {
        // Failed to place the order
        echo "Failed to place the order. Please try again.";
    }
} else {
    // Invalid request method
    echo "Invalid request.";
}
?>
