<?php


class Register{
    public static function login($conn, $name, $email, $password){
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, status) VALUES
        (':name',':email',':password',':status'");
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $password,
            'status' => 'online'
        ]);
    }
}