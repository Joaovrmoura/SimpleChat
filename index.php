<?php 

session_start();

if(isset($_GET['my_id'])){
  $_SESSION['id'] = $_GET['my_id'];
}
if(isset($_GET['user_id'])){
  $receiver_id = $_GET['user_id'];
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/index.css">
  <title>Chat App</title>

</head>

<body>

  <div class="container">
    <div class="navigation">
      <button class="nav-button active" id="chat">Chat</button>
      <button class="nav-button" id="friends">Amigos</button>
    </div>

    <!-- Página de Chat -->
    <span><i class="fas fa-arrow-left" id="back"></i></span>
    <div class="chat-page" id="chatPage">
      <div class="chat-container">

        <div class="chat-display">

          <!-- mensagens entre users -->
          <div class="message received">Olá! Como vai? <?= $_SESSION['id'] ?? 'não existe' ?> and <?= $receiver_id  ?? 'não existe'?></div>
          <div class="message sent">Oi! Tudo bem, e você?</div>
          <!-- mensagens entre users -->
    
        </div>

      </div>
      <div class="chat-input">
        <form class="formMenssage" action="">
          <input type="hidden" name="receiver_id" value="<?= $receiver_id ?>">
          <input type="hidden" name="myId" value="<?= $_SESSION['id'] ?>">
          <input type="text" placeholder="Digite sua mensagem...">
          <button>Enviar</button>
        </form>
      </div>
    </div>

    <!-- Página de Amigos e Mensagens -->
    <div class="friends-page" id="friendsPage">
      <div class="friends-container">
        <div class="sidebar">

          <div class="messages-list">
            <div class="list-title">Mensagens Recentes</div>
            <div class="message-item">
              <div class="avatar"></div>
              <div class="item-info">
                <div class="item-name">João Silva</div>
                <div class="item-preview">Olá! Como vai?</div>
              </div>
            </div>
            <div class="message-item">
              <div class="avatar"></div>
              <div class="item-info">
                <div class="item-name">Maria Santos</div>
                <div class="item-preview">Vamos marcar algo...</div>
              </div>
            </div>
          </div>


          <div class="friends-list">
          
            <div class="list-title">Amigos</div>
            <!-- item que exibe os usuários -->
            <!-- <div class="friend-item">
                   <div class="avatar"></div>
                   <div class="item-info">
                     <div class="item-name">João Silva</div>
                     <div class="item-preview">Online</div>
                   </div>
              </div> -->
            <!-- item que exibe os usuários -->
          </div>

        </div>
      </div>
    </div>
  </div>

  <script src="js/main.js"></script>
  <script src="js/listUsers.js"></script>
</body>

</html>