<?php
session_start();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

$product_name = $data['product_name'];
$product_price = $data['product_price'];
$user_id = $data['user_id'];
$errors = array();

// Connect to the database using PDO
$dsn = 'mysql:host=localhost;dbname=x3r77';
$username = '';
$password = '';
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

try {
    $pdo = new PDO($dsn, $username, $password, $options);
    if($product_name != null && $product_price!= null && $user_id != null){
    $stmt = $pdo->prepare("INSERT INTO orders (OrderedItem,Orderprice,User_ID) VALUES (:OrderedItem, :Orderprice, :User_ID)");
    $stmt->execute(array(
        ':OrderedItem' => $product_name,
        ':Orderprice' => $product_price,
        ':User_ID' => $user_id
    ));
    echo json_encode(array(
        "status" => true,
        "message" => "Thank You For Buying Our Product"
    ));
}
} catch (PDOException $e) {
    // Log any database errors
    error_log('Database error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(array(
        "status" => false,
        "message" => "Something went wrong. Please try again later."
    ));
}
$pdo = null;
