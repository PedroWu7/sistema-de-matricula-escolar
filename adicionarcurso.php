<?php
    session_start();
    if (!isset($_SESSION["usuario"]) || $_SESSION["usuario"] === "") {
        header("location: index.php");
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
        <form method="post" id="forCurso" name="formCurso">
            <h1>Criar curso</h1>

            <label for="criarNome">Nome</label>
            <input type="text" id="criarNome" name="criarNome" required>

            <label for="criarImagem">Imagem</label>
            <input type="text" id="criarImagem" name="criarImagem" required>

            <label for="criarDescricao">Descrição</label>
            <input type="text" id="criarDescricao" name="criarDescricao" required>

            <label for="addProfessor">Professor</label>
            <input type="text" id="addProfessor" name="addProfessor">

            <input type="submit" value="Criar Curso">

            
    </section>
</body>
</html>


<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        require_once "banco.php";

        adicionarCurso($conn, $_POST["criarNome"], $_POST["criarImagem"], $_POST["criarDescricao"], $_POST["addProfessor"]);
    };
    
?>