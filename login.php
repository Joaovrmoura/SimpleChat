<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <title>Document</title>
</head>
<body>
    <div class="container-register">
    <p class="message-alert"></p>
    <div class="registration-container">
        <h1>Logar</h1>
        <form class="registration-form">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" class="form-input" placeholder="Digite seu e-mail">

            <label for="password">Senha</label>
            <input type="password" id="password" name="password" class="form-input" placeholder="Digite sua senha" required>

            <button type="submit" class="form-button">Logar</button>
        </form>
        <a href="register.php" class="redirect">Ainda não tem Cadastro?</a>
    </div>
    </div>

<script src="./js/login.js"></script>
</body>
</html>