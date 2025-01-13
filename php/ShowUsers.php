<?php 

require '../database/Connection.php';
$conn = Connection::connection();
header('Content-type: application/json');

// retorna todos os usuários
class ShowUsers{
    public function showUsers($conn){
        $stmt_user = $conn->query("SELECT * FROM users");
        $stmt_user->execute();
        return $stmt_user->fetchAll(PDO::FETCH_ASSOC);
    }
}

$users = new ShowUsers();
$data_user = $users->showUsers($conn);
echo json_encode($data_user);
