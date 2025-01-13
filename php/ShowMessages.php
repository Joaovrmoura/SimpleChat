<?php 

require '../database/Connection.php';
$conn = Connection::connection();
header('Content-type: application/json');
// informações do rementente e e destinatário da menssagem(e as menssagens enviadas)
class ShowMessages{
    public function showMessages($conn,  $my_id = 1,  $other_user_id = 2){
        $query_message = "SELECT m.id_message, u_sender.name AS sender_name, u_receiver.name AS receiver_name, m.message,
        m.created_at FROM  messages m JOIN users u_sender ON m.sender_id = u_sender.id_user
        JOIN users u_receiver ON m.receiver_id = u_receiver.id_user 
        WHERE (m.sender_id = :my_id AND m.receiver_id = :other_user_id)
        OR (m.sender_id = :other_user_id AND m.receiver_id = :my_id) ORDER BY m.created_at ASC;";

        $stmt_message = $conn->prepare($query_message);
        $stmt_message->execute(
          [
            ':my_id' => $my_id,
            ':other_user_id' => $other_user_id
          ]
        );
        return $stmt_message->fetchAll(PDO::FETCH_ASSOC);
    }
}

$message = new ShowMessages();
echo json_encode($message->showMessages($conn));