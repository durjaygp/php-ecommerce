<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the input data
    $productName = isset($_POST['product_name']) ? $_POST['product_name'] : '';
    $productPrice = isset($_POST['product_price']) ? floatval($_POST['product_price']) : 0;
    $userPhone = isset($_POST['user_phone']) ? $_POST['user_phone'] : '';

    // Perform database connection and save the order data
    // Replace the following lines with your actual database connection code
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "live_react";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Perform data insertion into the database
    $sql = "INSERT INTO orders (product_name, product_price, user_phone) VALUES ('$productName', $productPrice, '$userPhone')";
    if ($conn->query($sql) === TRUE) {
        echo "Order saved successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>


// Handle the POST request and save the order data to the database
//if ($_SERVER["REQUEST_METHOD"] === "POST") {
//    // Get the data from the POST request
//    $productName = $_POST["product_name"];
//    $productPrice = $_POST["product_price"];
//    $userPhone = $_POST["user_phone"];
//
//    // Your database connection credentials
//    $servername = "localhost";
//    $username = "root";
//    $password = "";
//    $dbname = "live_react";
//
//    // Create a connection to the database
//    $conn = new mysqli($servername, $username, $password, $dbname);
//
//    // Check if the connection was successful
//    if ($conn->connect_error) {
//        die("Connection failed: " . $conn->connect_error);
//    }
//
//    // Prepare and execute the SQL query to insert the order data into the database
//    $stmt = $conn->prepare("INSERT INTO orders (product_name, product_price, user_phone) VALUES (?, ?, ?)");
//    $stmt->bind_param("sss", $productName, $productPrice, $userPhone);
//
//    if ($stmt->execute()) {
//        echo "Order saved successfully!";
//    } else {
//        echo "Error: " . $stmt->error;
//    }
//
//    // Close the statement and the database connection
//    $stmt->close();
//    $conn->close();
//}
//?>
