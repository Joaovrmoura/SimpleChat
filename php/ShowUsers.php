<?php

// Headers para permitir CORS
header('Access-Control-Allow-Origin: *');

session_start();

require '../src/database/Connection.php';
$conn = Connection::connection();

// retorna todos os usuários
    $stmt = $conn->query("SELECT id_user, name, status FROM users");
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($row) > 0) {
        foreach ($row as $rows){
            echo '
            <a href="chat.php?receiver_id='.$rows['id_user'].'" class="friend-item">
                <div class="avatar"></div>
                <div class="item-info">
                    <div class="item-name"> ' . $rows['name'] . ' </div>
                    <div class="item-preview"> '. $rows['status'] .'</div>
                </div> 
            </a>';
        }
        
    }else{
        echo "sem retorno";
    }

