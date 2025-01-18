<?php

class User{
    public function login($conn, $data)
    {
        try {
            if (empty($data->email) || empty($data->password)) {
                return false;
            }
            $email = filter_var($data->email, FILTER_SANITIZE_EMAIL);
            $password = htmlspecialchars(
                trim($data->password),
                ENT_QUOTES,
                'UTF-8'
            );

            $stmt = $conn->prepare("SELECT * FROM users WHERE email= :email");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_OBJ);

            if ($user && password_verify($password, $user->password)) {
                $_SESSION['user_id'] = $user->id_user;
                return $_SESSION['user_id'];
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    
    public function register($conn, $data){

        if (empty($data->name) || empty($data->email) || empty($data->password)) {
            return false;
        }

        $email = filter_var($data->email, FILTER_SANITIZE_EMAIL);
        $name = htmlspecialchars($data->name);
        $password_hash = password_hash($data->password, PASSWORD_DEFAULT);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $stmt1 = $conn->prepare("SELECT * FROM users WHERE email=:email");
        $stmt1->execute([':email' => $email]);
        $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

        if ($row1) {
            return false;
        } else {
            $stmt2 = $conn->prepare("INSERT INTO users (name, email, password, status) 
                VALUES(:name, :email, :password, :status)");

            $stmt2->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $password_hash,
                'status' => 'online'
            ]);
            if ($stmt2) {
                $stmt3 = $conn->prepare("SELECT * FROM users WHERE email=:email");
                $stmt3->execute([':email' => $email]);
                $row2 = $stmt3->fetch(PDO::FETCH_OBJ);
                $_SESSION['user_id'] = $row2->id_user;

                return true;
            } else {
                return false;
            }
        }
    }


    public function getUsers($conn)
    {
        $stmt = $conn->query("SELECT id_user, name, status FROM users");
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($row) > 0) {
            return $row;
        }
        return false;
    }
}

// header('Content-type: application/json');

// require '../database/Connection.php';
// $conn = Connection::connection();
// $u = new User();

// $data = [
//     'email' => 'joaovrmoura5@gmail.com', 
//     'password' => '123'
// ];
// $dataArr = json_encode($data);
// $dataDec = json_decode($dataArr);

// var_dump($u->login($conn, $dataDec));