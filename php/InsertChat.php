<?php 

require '../database/Connection.php';
$conn = Connection::connection();

class InsertChat{
    public function insertMessage($conn, $myId, $user_id, $message){
        $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) 
        VALUES(:myId, :user_id, :message)");
        return $stmt->execute([
            ':myId' => $myId,
            ':user_id' => $user_id,
            ':message' => $message
        ]);
    }
}

$insert =new InsertChat();
$insert->insertMessage($conn, 1, 2, "ola maria novamente!");
