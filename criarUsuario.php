<?php
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["usuario"] !== ""){
        if ($_GET["from"] === "dashboard"){
            echo "<script>";
            echo "confirm('Vocë já está cadastrado!');";
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
            <h1>Cadastre-se</h1>

            <label for="criarNome">Nome</label>
            <input type="text" id="criarNome" name="criarNome" required>

            <label for="criarUsuario">Usuário</label>
            <input type="text" id="criarUsuario" name="criarUsuario" required>

            <label for="criarSenha">Senha</label>
            <input type="password" id="criarSenha" name="criarSenha" required>
            <input type="submit" value="Criar Conta">

            
    </section>
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        require_once "banco.php";
        $criarUsuario = $_POST["criarUsuario"];
        $existe = usuarioExiste($conn, $criarUsuario);
        if($existe){
            echo"Usuario já existente.";
        } else { 
            adicionarUsuario($conn, $_POST["criarUsuario"], $_POST["criarNome"], $_POST["criarSenha"]);
         }
    }
?>