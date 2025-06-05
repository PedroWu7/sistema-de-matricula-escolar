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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
        <form method="post" action="" id="formLogin" name="formLogin">
            <h1>Cadastre-se</h1>

            <label for="criarNome">Nome</label>
            <input type="text" id="criarNome" name="criarNome" required>

            <label for="criarUsuario">Usuário</label>
            <input type="text" id="criarUsuario" name="criarUsuario" required>

            <label for="criarSenha">Senha</label>
            <input type="password" id="criarSenha" name="criarSenha" required>
            <input type="submit" value="Criar Conta">
            <input type="submit" onclick="window.location.href='../sistema-de-matricula-escolar/login'" value="Login">

            
    </section>
</body>
</html>

<?php
    
?>