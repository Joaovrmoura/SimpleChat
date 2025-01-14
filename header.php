<?php 

session_start();

if(isset($_GET['my_id'])){
  $_SESSION['id'] = $_GET['my_id'];
}

if(isset($_GET['user_id'])){
  $receiver_id = $_GET['user_id'];
}

// require './src/helpers.php';

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

<!-- <div class="ids" style="display:none">
  <p class="my_id"><?= $_SESSION['id'] ?? 'não existe' ?> </p>
  <p class="receiver_id"> <?= $receiver_id  ?? 'não existe'?></p>
</div> -->

  <div class="container">

<input type="hidden" id="myId" value="<?= $_SESSION['id'] ?? '' ?>">
<input type="hidden" id="receiverId" value="<?= $receiver_id ?? '' ?>">