<?php include 'header.php'; ?>
  <!-- Página de Chat -->
    <span><a href="index.php"><i class="fas fa-arrow-left" id="back"></i></a></span>
    <div class="chat-page"id="chatPage">
      <div class="chat-container">

        <div class="chat-display">

          <!-- mensagens entre users -->
          <!-- <div class="message received">Olá! Como vai?</div>
          <div class="message sent">Oi! Tudo bem, e você?</div> -->
          <!-- mensagens entre users -->

        </div>

      </div>

        <form class="chat-input" action="">
          <input type="hidden" name="receiver_id" value="<?= $receiver_id ?>">
          <input type="hidden" name="myId" value="<?= $_SESSION['id'] ?>">
          <input type="text" name="message" placeholder="Digite sua mensagem...">
          <button class="sendChat" type="submit">Enviar</button>
        </form>
      </div>
    </div>
  </div>
<script src="js/chat.js"></script>
  <?php include 'footer.php'; ?>