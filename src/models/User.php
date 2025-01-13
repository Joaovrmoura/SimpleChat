<?php

class User{

    public function login($conn, $data){
        try{
            if(empty($data->email) || empty($data->password)){
                return false;
            }
            $email = filter_var($data->email, FILTER_SANITIZE_EMAIL);
            $password = htmlspecialchars(trim($data->password), 
            ENT_QUOTES, 'UTF-8');
             
            $stmt = $conn->prepare("SELECT * FROM users WHERE email= :email");
            $stmt->execute([':email'=> $email]);
            $user = $stmt->fetch(PDO::FETCH_OBJ);

            if($user && password_verify($password, $user->password)){
                return $user;
            }else{
                return false;
            }

        }catch(PDOException $e){
            return$e->getMessage();
        }
    }
    public function register($conn, $data){
       
        try{
            if(empty($data->name) || empty($data->email) || empty($data->password)){
                throw new Exception('Preencha todos os campos');
            }
            $email = filter_var($data->email, FILTER_SANITIZE_EMAIL);
            $name = htmlspecialchars($data->name);
            $password_hash = password_hash($data->password, PASSWORD_DEFAULT);

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
               throw new Exception('E-mail inválido');
            }
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, status) 
            VALUES(:name, :email, :password, :status)");
            
            return $stmt->execute([':name' => $name,':email' => $email,
            ':password' => $password_hash,'status' => 'online'
            ]);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
       
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