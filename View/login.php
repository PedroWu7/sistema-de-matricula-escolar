<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
      }
  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./View/style.css">
</head>
<body>
    <section>
        <form method="post" action="" id="formLogin" name="formLogin">
            <h1>Login</h1>
            <label for="inputUsuario">Usuário</label>
            <input type="text" id="inputUsuario" name="inputUsuario" required>

            <label for="inputSenha">Senha</label>
            <input type="password" id="inputSenha" name="inputSenha" required>
            <input type="submit" value="Logar">
            <input type="submit" onclick="window.location.href='cadastrar'" value="Cadastrar">
            <!-- Botão 'Esqueci a Senha' -->
            <p><a href = "esqueciSenha.php">Esqueceu a senha?</a></p>
        </form>
    </section>
</body>
</html>

