<?php

// atualiza o chat com as menssagens recebidas e enviadas
session_start();
require_once '../src/database/Connection.php';
header('Content-type: application/json');

if (isset($_SESSION['user_id'])) {

    $dataArr = file_get_contents('php://input');
    $data = json_decode($dataArr);
    $my_id = $_SESSION['user_id'];

    $query_message = "SELECT m.id_message, m.sender_id, m.receiver_id, u_sender.name AS sender_name, 
    u_receiver.name AS receiver_name, m.message, m.created_at FROM  messages m JOIN users u_sender 
    ON m.sender_id = u_sender.id_user JOIN users u_receiver ON m.receiver_id = u_receiver.id_user 
    WHERE (m.sender_id = :my_id AND m.receiver_id = :other_user_id) OR (m.sender_id = :other_user_id 
    AND m.receiver_id = :my_id) ORDER BY m.created_at ASC;";

    $stmt_message = $conn->prepare($query_message);
    $stmt_message->execute(
      [
      ':my_id' => $my_id,
      ':other_user_id' => $data->user_id
       ]
      );
   $chat = $stmt_message->fetchAll(PDO::FETCH_ASSOC);
    if ($chat) {
      json_encode('<!-- mensagens entre users -->
          <!-- <div class="message received">Olá! Como vai?</div>
          <div class="message sent">Oi! Tudo bem, e você?</div> -->
          <!-- mensagens entre users -->');
    }
       return false;
    } else {
      echo "não existe";
    }
