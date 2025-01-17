<?php

session_start();
require_once '../src/database/Connection.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json'); 

$conn = Connection::connection();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $email = filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL);
    $name = htmlspecialchars( $_POST['name']);
    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('E-mail inválido');
    }
    
    $stmt1 = $conn->prepare("SELECT * FROM users WHERE email=:email");
    $stmt1->execute([':email' => $email]);
    $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

    if($row1){
        echo json_encode(['success' => false, 'message'=> 'email ja existe']);
    }else{
        $stmt2 = $conn->prepare("INSERT INTO users (name, email, password, status) 
        VALUES(:name, :email, :password, :status)");
   
        $stmt2->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $password_hash,
            'status' => 'online'
        ]);
        
        if($stmt2){ 
            $stmt3 = $conn->prepare("SELECT * FROM users WHERE email=:email");
            $stmt3->execute([':email' => $email]);  
            $row2 = $stmt3->fetch(PDO::FETCH_ASSOC);

            $_SESSION['user_id'] = $row2['id_user'];
            
            echo json_encode([
                'success' => true, 'message' => 'LOGIN NAO EXISTE E FOI CADASTRADO SEU ID E: ' . $row2['id_user']
            ]);

        }else{
            echo json_encode(['success' => false, 'message'=> 'algo deu errado!']);
        }
    }
}
