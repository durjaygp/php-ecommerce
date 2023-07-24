<?php
session_start();

// Perform user login validation here
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Replace 'your_db_host', 'your_db_username', 'your_db_password', and 'your_db_name' with your database credentials
    $connection = mysqli_connect('localhost', 'root', '', 'live_react');
    if (!$connection) {
        die('Database connection error: ' . mysqli_connect_error());
    }

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Query failed: ' . mysqli_error($connection));
    }

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Store user data in the session
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];

        // Redirect to a page after successful login (e.g., index.php)
        header('Location: index.php');
        exit();
    } else {
        echo 'Invalid email or password.';
    }

    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <label>Email:</label>
        <input type="text" name="email" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
