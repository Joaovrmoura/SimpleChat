<?php 


class ListUsers{
    public function getUsers($conn){
        $stmt = $conn->query("SELECT id_user, name, status FROM users");
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($row) > 0){
            return $row;
        }
        return false;
    }
}