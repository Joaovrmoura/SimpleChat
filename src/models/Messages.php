<?php 

class Messages{
    public function showMyMessges($conn, $data){
        // Lógica para obter mensagens
        $query_chats = "SELECT u.id_user, m.message,  m.created_at, u.name AS sender_name FROM 
        messages m JOIN users u ON m.sender_id = u.id_user WHERE 
        m.receiver_id = :my_id ORDER BY m.created_at ASC";
    
        $stmt_chats = $conn->prepare($query_chats);
        $stmt_chats->execute([':my_id' => $data->id]);

        return $stmt_chats->fetchAll(PDO::FETCH_ASSOC);
    }

    public function InsertChat($conn, $data){
        $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) 
        VALUES(:myId, :user_id, :message)");
        return $stmt->execute([
            ':myId' => $data->id,
            ':user_id' => $data->user_id,
            ':message' => $data->message
        ]);
    }
    
    // atualiza o chat com as menssagens recebidas e enviadas
    public function ChatMessages($conn, $data){
        $query_message = "SELECT m.id_message, u_sender.name AS sender_name, u_receiver.name AS receiver_name, m.message,
        m.created_at FROM  messages m JOIN users u_sender ON m.sender_id = u_sender.id_user
        JOIN users u_receiver ON m.receiver_id = u_receiver.id_user 
        WHERE (m.sender_id = :my_id AND m.receiver_id = :other_user_id)
        OR (m.sender_id = :other_user_id AND m.receiver_id = :my_id) ORDER BY m.created_at ASC;";

        $stmt_message = $conn->prepare($query_message);
        $stmt_message->execute(
          [
            ':my_id' => $data->id,
            ':other_user_id' => $data->user_id
          ]
        );
        return $stmt_message->fetchAll(PDO::FETCH_ASSOC);
    }

    public function destroyMessage(){
        return true;
    }
}

