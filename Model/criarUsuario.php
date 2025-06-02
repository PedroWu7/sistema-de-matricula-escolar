<?php
    session_start();//Coloquei esse arquivo,o criarUsuario apenas para o github reconhecer a criacao da pasta Model para o MVC, para nao bugar.
    if(isset($_SESSION["usuario"]) && $_SESSION["usuario"] !== "" && $_SESSION["usuario"] !== "Guest") {
        echo "Você já está cadastrado!";//arrumar dps
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
            <input type="submit" onclick="window.location.href='login.php'" value="Login">

            
    </section>
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        require_once "banco.php";
        $criarUsuario = $_POST["criarUsuario"];
        $criarSenha = $_POST["criarSenha"];
        $existe = usuarioExiste($conn, $criarUsuario, $criarSenha);
        if($existe){
            echo"Usuario já existente.";
        } else { 
            adicionarUsuario($conn, $_POST["criarUsuario"], $_POST["criarNome"], $_POST["criarSenha"]);
         }
    }
?>