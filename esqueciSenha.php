<!-- esqueciSenha.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Senha</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
        <form method="post">
            <h1>Recuperar Senha</h1>
            <label for="usuarioEmail">Informe seu usuário ou e-mail</label>
            <input type="text" id="usuarioEmail" name="usuarioEmail" required>
            <input type="submit" value="Enviar recuperação">
        </form>
    </section>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuarioEmail = $_POST["usuarioEmail"];

    require_once "banco.php";
    $sql = "SELECT * FROM alunos WHERE usuario = '$usuarioEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<p>Instruções para redefinir a senha foram enviadas (simulação).</p>";
        // Aqui você poderia enviar um e-mail real ou gerar um token para redefinição.
    } else {
        echo "<p>Usuário não encontrado.</p>";
    }
}
?>
