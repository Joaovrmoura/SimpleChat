<?php 

session_start();


if(!isset($_SESSION['user_id'])){
  header('location: login.php');
}


if(isset($_GET['user_id'])){
    $receiver_id = $_GET['user_id'];
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/index.css">
  <title>Chat App</title>

</head>
<body>
  <div class="container">
