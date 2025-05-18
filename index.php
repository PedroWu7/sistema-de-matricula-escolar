<?php
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["usuario"] !== ""){
        if ($_GET["from"] === "dashboard"){
            echo "<script>";
            echo "confirm('Vocë já está logado!');";
            echo "window.location.href = 'dashboard.php';";
            echo "</script>";
        } else {
            header("location: dashboard.php");
        }
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
        </form>
    </section>
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        require_once "banco.php";
        $inputUsuario = $_POST["inputUsuario"];
        $inputSenha = $_POST["inputSenha"];
        $existe = usuarioExiste($conn, $inputUsuario, $inputSenha);
        if($existe){
            $_SESSION["usuario"] = $inputUsuario ?? null;
            $_SESSION["senha"] = $inputSenha ?? null;
            header("location: dashboard.php");
        } else { ?>
            <p>Usuário ou senha incorretos.</p>
        <?php }
    }
?>