<?php
session_start();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

$email = $data['email'];
$password = $data['password'];

// Perform validation on the inputs
$errors = array();

if (empty($email)) {
    $errors[] = "Email is required";
}

if (empty($password)) {
    $errors[] = "Password is required";
}

if (!empty($errors)) {
    echo json_encode(array(
        "status" => false,
        "message" => implode(",", $errors)
    ));
} else {
    $dsn = 'mysql:host=localhost;dbname=x3r77';
    $username = '';
    $passwords = '';
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    try {
        $pdo = new PDO($dsn, $username, $passwords, $options);

        // Prepare the query and execute it
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(array(
            'email' => $email,
        ));
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo json_encode(array(
                "status" => false,
                "message" => "Invalid email"
            ));
        } else {
            if ($user['password'] !== $password) {
                echo json_encode(array(
                    "status" => false,
                    "message" => "Invalid password"
                ));
            } else {
                $_SESSION['user'] = $user;
                echo json_encode(array(
                    "status" => true,
                    "message" => "Login successful",
                    "user" => $user
                ));
            }
        }
    } catch (PDOException $e) {
        echo json_encode(array(
            "status" => false,
            "message" => "Database error: " . $e->getMessage()
        ));
    }
    $pdo = null;
}

?> 