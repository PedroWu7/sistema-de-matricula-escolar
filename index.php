<?php
    session_start();
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
    <h1>Sistema Escolar</h1>
    <section>
        <form method="post" id="formLogin" name="formLogin">
            <h1>Login</h1>
            <label for="inputUsuario">Usuário</label>
            <input type="text" id="inputUsuario" name="inputUsuario">

            <label for="inputSenha">Senha</label>
            <input type="password" id="inputSenha" name="inputSenha">
            <input type="submit" value="Logar">
        </form>
    </section>
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        $inputUsuario = $_POST["inputUsuario"];
        $inputSenha = $_POST["inputSenha"];
        
        $_SESSION["usuario"] = $inputUsuario;
        $_SESSION["senha"] = $inputSenha;
    }
?>