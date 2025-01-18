<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/style.css">
    <title>Document</title>
</head>
<body>
<div class="container-register">
<p class="message-alert"></p>
    <div class="registration-container">
        <h1>Cadastro</h1>
        <form class="registration-form">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" class="form-input" placeholder="Digite seu nome">

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" class="form-input" placeholder="Digite seu e-mail">

            <label for="password">Senha</label>
            <input type="password" id="password" name="password" class="form-input" placeholder="Digite sua senha" required>

            <label for="confirm-password">Confirme a Senha</label>
            <input type="password" id="confirm-password" name="confirmPassword" class="form-input" placeholder="Confirme sua senha" required>

            <button type="submit" class="form-button">Cadastrar</button>
        </form>
        <a href="login.php" class="redirect">Já tem Cadastro?</a>
    </div>
    </div>
    <script src="./src/js/register.js"></script>
</body>
</html>