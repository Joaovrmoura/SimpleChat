<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/index.css">
    <title>Document</title>
</head>

<body>

    <div class="chat-window">
        <div class="chat-header">
            <span><i class="fas fa-arrow-left" id="back"></i></span>
            <h3>Chat</h3>
        </div>

        <div class="navigation">
            <button class="nav-button active" id="chat">Amigos</button>
            <button class="nav-button chat" id="friends">Chat</button>
        </div>
        <div class="chat-footer">
            <form class="myform" action="">
                <input type="text" placeholder="Digite sua mensagem..." name="message" class="chat-input">
                <button class="send-button">Enviar</button>
            </form>
        </div>
    </div>

</body>

</html>