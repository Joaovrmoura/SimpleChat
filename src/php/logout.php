<?php 

define('ROOT_URL', 'http://localhost:3000/xampp/htdocs/chatSimples/login.php');

session_unset(); 

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();
header('location:'.ROOT_URL);
exit;
