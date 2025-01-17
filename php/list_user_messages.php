<?php


require_once '../src/database/Connection.php';
header('Content-type: application/json');
$conn = Connection::connection();

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-type: application/json');

session_start();

if(isset($_SESSION['user_id'])){
// Lógica para obter mensagens
    $dataArr = file_get_contents('php://input');
    $data = json_decode($dataArr);  
    $query_chats = 
    "SELECT  u.id_user,  m.message, m.receiver_id, m.created_at, u.name AS 
    sender_name, r.name AS receiver_name FROM messages m
    JOIN 
        users u ON m.sender_id = u.id_user
    JOIN 
        users r ON m.receiver_id = r.id_user
    WHERE 
        m.receiver_id = :my_id OR m.sender_id = :my_id
    ORDER BY 
        m.created_at ASC";


    $stmt_chats = $conn->prepare($query_chats);
    $stmt_chats->execute([':my_id' => $data->my_id]);
    $messages = $stmt_chats->fetchAll(PDO::FETCH_ASSOC);

    if($messages){
        return $messages;
    }
    return false;
}else{
    echo json_encode("não existe session!");
}