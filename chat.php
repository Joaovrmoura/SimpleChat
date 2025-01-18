<?php include 'header.php'; 

session_start();

if(!isset($_SESSION['user_id'])){
  header('location: login.php');
}

?>
  <!-- Página de Chat -->
    <span><a href="users.php">
      <i class="fas fa-arrow-left" id="back"></i>
    </a></span>
    <div class="chat-page"id="chatPage">
      <div class="chat-container">

        <div class="chat-display">
        </div>

      </div>

        <form class="chat-input" action="">
          <input type="hidden"  name="receiver_id" value="<?= $_GET['receiver_id'] ?? '' ?>">
          <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>" >
          <input type="text" name="message" placeholder="Digite sua mensagem...">
          <button class="sendChat" type="submit">Enviar</button>
        </form>
      </div>
    </div>
  </div>

<script src="./src/js/chat.js"></script>