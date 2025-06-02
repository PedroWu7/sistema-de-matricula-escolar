<?php
    session_start();
    if(isset($_SESSION["usuario"]) && $_SESSION["usuario"] !== "" && $_SESSION["usuario"] !== "Guest") {
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
        <form method="post" id="formLogin" name="formLogin">
            <h1>Login</h1>
            <label for="inputUsuario">Usuário</label>
            <input type="text" id="inputUsuario" name="inputUsuario" required>

            <label for="inputSenha">Senha</label>
            <input type="password" id="inputSenha" name="inputSenha" required>
            <input type="submit" value="Logar">
            <input type="submit" onclick="window.location.href='criarUsuario.php'" value="Cadastrar">
            <!-- Botão 'Esqueci a Senha' -->
            <p><a href = "esqueciSenha.php">Esqueceu a senha?</a></p>
        </form>
    </section>
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        include "banco.php";
        $inputUsuario = $_POST["inputUsuario"];
        $inputSenha = $_POST["inputSenha"];

        $existe = usuarioExiste($conn, $inputUsuario, $inputSenha);
        if($existe){
            header("location: index.php");
        } else { ?>
            <p>Usuário ou senha incorretos.</p>
        <?php }
    }
?>