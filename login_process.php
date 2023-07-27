<?php
// Assuming you have a database connection already established
$connection = mysqli_connect('localhost', 'root', '', 'live_react');

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    // Validate the data (you can add more validation if needed)
    if (empty($phone) || empty($password)) {
        http_response_code(400); // Bad request status code
        echo json_encode(["success" => false]);
        exit;
    }

    // Sanitize the data (optional, but good practice to prevent SQL injection)
    $phone = mysqli_real_escape_string($connection, $phone);
    $password = mysqli_real_escape_string($connection, $password);

    // Query the database to check if the user exists and the password is correct
    $query = "SELECT * FROM users WHERE phone = '$phone' AND password = '$password'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        // User login is successful
        http_response_code(200); // Success status code
        echo json_encode(["success" => true]);
    } else {
        // Invalid phone number or password
        http_response_code(401); // Unauthorized status code
        echo json_encode(["success" => false]);
    }

    // Close the database connection
    mysqli_close($connection);
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed status code
    echo json_encode(["success" => false]);
}
?>
