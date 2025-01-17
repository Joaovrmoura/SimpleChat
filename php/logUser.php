<?php

session_start();
require_once '../src/database/Connection.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json'); 

$conn = Connection::connection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];


    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_OBJ);


    if ($user && password_verify($password, $user->password)) {
        
        $_SESSION['user_id'] = $user->id_user;
        echo json_encode(['success' => true, 'message' => 'Login bem-sucedido']);
    } else {

        echo json_encode(['success' => false, 'message' => 'Credenciais inválidas']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Requisição inválida']);
}
?>
