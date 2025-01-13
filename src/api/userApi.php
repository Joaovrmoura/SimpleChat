<?php

require_once '../helpers.php';

switch ($data->action) {
    case 'register':
        if(!$user->register($conn, $data)){
            sendJsonResponse(false,'algo deu errado',$data);
        }else{
            sendJsonResponse(true,'Registrado', );
        }
        break;

    case 'login':
        if(!$user->login($conn, $data)){
            sendJsonResponse(false, 'algo deu errado',$data);
        }else{
            sendJsonResponse(true, 'logado com sucesso', 
            $user->login($conn, $data));
        }
        case 'list':
            if(!$listUser->getUsers($conn)){
                sendJsonResponse(false, 'algo deu errado',$data);
            }else{
                sendJsonResponse(true, 'Sucesso na resposta!', 
                $listUser->getUsers($conn));
            }
        break;
    default:
        sendJsonResponse(false,'Rota não encontrada!',null);
        break;
}
