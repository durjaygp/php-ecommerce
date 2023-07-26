<?php
// Assuming you have a database connection already established
$connection = mysqli_connect('localhost', 'root', '', 'live_react');
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the data sent via AJAX
    $productName = $_POST["product_name"];
    $productPrice = $_POST["product_price"];
    $userPhone = $_POST["user_phone"];

    // Validate the data (you can add more validation if needed)
    if (empty($productName) || empty($productPrice) || empty($userPhone)) {
        http_response_code(400); // Bad request status code
        echo "Error: Incomplete data provided.";
        exit;
    }

    // Sanitize the data (optional, but good practice to prevent SQL injection)
    $productName = htmlspecialchars($productName);
    $productPrice = floatval($productPrice);
    $userPhone = htmlspecialchars($userPhone);

    // Save the order data to the database (replace this with your actual database logic)
    // Assuming you have a table named "orders" with columns "product_name", "product_price", and "user_phone"
    $query = "INSERT INTO orders (product_name, product_price, user_phone) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("sds", $productName, $productPrice, $userPhone);

    if ($stmt->execute()) {
        // Order saved successfully
        http_response_code(200); // Success status code
        echo "Order saved successfully!";
    } else {
        // Error saving the order
        http_response_code(500); // Internal Server Error status code
        echo "Error: Unable to save the order.";
    }

    // Close the database connection (if you have not done it already)
    $connection->close();
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed status code
    echo "Error: Invalid request method.";
}
