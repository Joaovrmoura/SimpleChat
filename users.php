<?php include 'header.php'; 

session_start();
if(!isset($_SESSION['user_id'])){
  header('location: login.php');
}
?>

<!-- Página de Amigos e Mensagens -->
<div class="friends-page" id="friendsPage">
  <div class="friends-container">
    <div class="sidebar">
      <div class="list-title">Mensagens Recentes <a href="./src/php/logout.php" name="exit" class="exitBtn">Sair</a></div>
    
      <div class="messages-list">

        
      </div>
      
      <div class="list-title">Amigos </div>
      <div class="friends-list">
           
      </div>

    </div>
  </div>
</div>
</div>
<input type="hidden" class="user_id" value="<?= $_SESSION['user_id'] ?>">

<script src="./src/js/userMessages.js"></script>
<script src="./src/js/listUsers.js"></script>