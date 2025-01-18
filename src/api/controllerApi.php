<?php

require_once '../php/helpers.php';

session_start();

$user = new User();
$listUser = new User();
$myMessages = new Messages();
$chatMessages = new Messages();
$insertMessage = new Messages();

switch ($data->action)
{
    case 'register':
        if (!$user->register($conn, $data)) {
            sendJsonResponse(false, 'algo deu errado', $data);
        } else {
            sendJsonResponse(true, 'Registrado', 
            $user->register($conn, $data));
        }
        break;

    case 'login':
        if (!$user->login($conn, $data)) {
            sendJsonResponse(false, 'algo deu errado', $data);
        } else {
            $_SESSION['user_id'] = $data;
            sendJsonResponse(
                true,
                'logado com sucesso',
                $user->login($conn, $data),
            );
        }
        break;

    case 'list':
        if (!$listUser->getUsers($conn)) {
            sendJsonResponse(false, 'algo deu errado', $data);
        } else {
            sendJsonResponse(
                true,
                'Sucesso na resposta!',
                $listUser->getUsers($conn)
            );
        }
        break;

    case 'user-message':
        if (!$myMessages->showMyMessges($conn, $data)) {
            sendJsonResponse(false, 'Data não foi enviado', $data);
        } else {
            sendJsonResponse(
                true,
                'Pegue suas menssagens',
                $myMessages->showMyMessges($conn, $data),
            );
        }
        break;

    case 'list-my-messages':
        if (!$chatMessages->ChatMessages($conn, $data)) {
            sendJsonResponse(false, 'Menssagens não encontradas!', $data);
        } else {
            sendJsonResponse(
                true,
                'Menssagens encontradas no banco!',
                $chatMessages->ChatMessages($conn, $data),
            );
        }
        break;

    case 'update-messages':
        if (!$insertMessage->InsertChat($conn, $data)) {
            sendJsonResponse(false, 'Menssagens não enviadas', $data);
        } else {
            sendJsonResponse(true, 'Menssagem enviada com sucesso', $data);
        }
        break;

    default:
        sendJsonResponse(false, 'Rota não encontrada!', null);
        break;
}
