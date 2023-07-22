<?php
session_start();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

$name = $data['name'];
$phone = $data['phone'];
$email = $data['email'];
$passwords = $data['password'];
$token = $data['token'];
$errors = array();

if (empty($name)) {
    $errors[] = "Name is required";
}

if (empty($phone)) {
    $errors[] = "Phone number is required";
}
if (empty($email)) {
    $errors[] = "Email is required";
}

if (empty($passwords)) {
    $errors[] = "Password is required";
}

if (empty($token)) {
    $errors[] = "Csrf Token is Missing";
}

if (!empty($errors)) {
    echo json_encode(array(
        "status" => false,
        "message" => implode(",", $errors)
    ));
} else {
// Connect to the database using PDO
$dsn = 'mysql:host=localhost;dbname=x3r77';
$username = '';
$password = '';
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

try {
    $pdo = new PDO($dsn, $username, $password, $options);

    // Check if the email already exists in the database
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
    $stmt->execute(array(':email' => $email));
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo json_encode(array(
            "status" => false,
            "message" => "Email already exists"
        ));
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (name, phone, email, password, Csrf_Token) VALUES (:name, :phone, :email, :password, :token)");
        $stmt->execute(array(
            ':name' => $name,
            ':phone' => $phone,
            ':email' => $email,
            ':password' => $passwords,
            ':token' => $token 
        ));

        echo json_encode(array(
            "status" => true,
            "message" => "User registered successfully"
        ));
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