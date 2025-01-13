<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Headers para permitir CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-type: application/json');

require_once 'database/Connection.php';
require_once 'models/User.php';
require_once 'models/listUsers.php';
require_once 'models/Messages.php';

$conn = Connection::connection();
$user = new User();
$listUser = new ListUsers();


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $arr_data = file_get_contents('php://input');
    $data = json_decode($arr_data);

    if (!$data || !isset($data->action)) {
        sendJsonResponse(false, 
        'Dados inválidos ou ação não informada!',
        null);
    }
} else {
    sendJsonResponse(false, 
    'Erro no Método de requisição',
    null);
}

function sendJsonResponse($success, $message,  $data = null, $user_id=null){
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data,
    ]);
    exit;
}

