<?php


require '../src/database/Connection.php';
$conn = Connection::connection();

// lista de menssagens enviadas ao usuário
class ListMessages
{
    public function getChat($conn)
    {
        // sql que liga através do id na tabela menssagens os usuários 

        $query_chats = "SELECT u.id_user, m.message,  m.created_at, u.name AS sender_name FROM 
        messages m JOIN  users u ON m.sender_id = u.id_user WHERE 
        m.receiver_id = :my_id ORDER BY m.created_at ASC";

        $stmt_chats = $conn->prepare($query_chats);
        $stmt_chats->execute([':my_id' => 1]);
        return $stmt_chats->fetchAll(PDO::FETCH_ASSOC);
    }
}

$u = new ListMessages();
echo "<pre>";
var_dump($u->getChat($conn));
echo "</pre>";

