<?php

include '../helpers.php';
require_once '../models/Messages.php';
$myMessages = new Messages();
$chatMessages = new Messages();
$insertMessage = new Messages();


switch($data->action){
    case 'user-message':
        if(!$myMessages->showMyMessges($conn, $data)){
            sendJsonResponse(false, 'Data não foi enviado', $data);
        }else{
            sendJsonResponse(true, 'Pegue suas menssagens', 
            $myMessages->showMyMessges($conn, $data));
        }
        break;

    case 'list-my-messages':
        if(!$chatMessages->ChatMessages($conn, $data)){
            sendJsonResponse(false, 'Menssagens não encontradas!', $data);
        }else{
            sendJsonResponse(true, 'Menssagens encontradas no banco!', 
            $chatMessages->ChatMessages($conn, $data));
        }
    break;

    case 'update-messages':
        if(!$insertMessage->InsertChat($conn, $data)){
            sendJsonResponse(false, 'Menssagens não enviadas', $data);
        }else{
            sendJsonResponse(true, 'Menssagem enviada com sucesso', $data);
        }

}

