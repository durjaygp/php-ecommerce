<?php
session_start();
// Assuming you have a database connection already established
$connection = mysqli_connect('localhost', 'root', '', 'live_react');
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the data sent via AJAX
    try{
        $product_id = $_POST["product_id"];

        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            $userPhone = $_SESSION["phone"];
            $customerName = $_SESSION["name"];
            $emailID = $_SESSION["email"];

           // customer name, email ID, phone number,
        }else{
            header("Location: login.php");
        }

        // Validate the data (you can add more validation if needed)
        if (empty($product_id) || empty($userPhone)) {
            http_response_code(400); // Bad request status code
            echo "Error: Incomplete data provided.";
            exit;
        }

        $query = "SELECT * FROM products WHERE id = '$product_id' LIMIT 1";
        $result = mysqli_query($connection, $query);
        $product = mysqli_fetch_assoc($result);


        // Sanitize the data (optional, but good practice to prevent SQL injection)
        $productName = $product['name'];
        $productPrice = $product['product_price'];
        $customerName = $_SESSION["name"];
        $emailID = $_SESSION["email"];


        // Save the order data to the database (replace this with your actual database logic)
       // product_name product_price customer_name email_id user_phone ordered_item
        $query = "INSERT INTO orders (product_name, product_price, customer_name, email_id, user_phone) VALUES ('$productName',$productPrice,'$customerName','$emailID','$userPhone')";
        $result = mysqli_query($connection, $query);
        if ($result) {
            echo "order save";
            exit;
            // Order saved successfully
            http_response_code(200); // Success status code
            echo "Order saved successfully!";
        } else {
            echo "order not save";
            exit;
            // Error saving the order
            http_response_code(500); // Internal Server Error status code
            echo "Error: Unable to save the order.";
        }
    }catch(Exception $e){
        return $e->getMessage();
    }


    // Close the database connection (if you have not done it already)
    $connection->close();
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed status code
    echo "Error: Invalid request method.";
}
