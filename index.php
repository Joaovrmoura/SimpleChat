<?php include 'header.php'; ?>
<!-- Página de Amigos e Mensagens -->
<div class="friends-page" id="friendsPage">
  <div class="friends-container">
    <div class="sidebar">
  
      <div class="list-title">Mensagens Recentes<a href="logout.php" name="exit" class="exitBtn">Sair</a></div>
    
      <div class="messages-list">

            <!-- menssagem enviadas ao usuário -->
            <!-- <div class="message-item">
              <div class="avatar"></div>
              <div class="item-info">
                <div class="item-name">joao</div>
                <div class="item-preview">$message['message']</div>
              </div>
            </div> -->
            <!-- menssagem enviadas ao usuário -->
        
      </div>
      
      <div class="list-title">Amigos</div>
      <div class="friends-list">

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
<input type="hidden" class="user_id" value="<?= $_SESSION['user_id'] ?>">

<script src="js/userMessages.js"></script>
<script src="js/listUsers.js"></script>

<?php include 'footer.php'; ?>