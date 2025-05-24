<?php
session_start();
require_once "banco.php";

if ($_SESSION["nivel_acesso"] !== "administrador") {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST["id"]);
    $nome = $_POST["nome"];
    $imagem = $_POST["imagem"];
    $descricao = $_POST["descricao"];
    $professor = $_POST["professor"];

    $sql = "UPDATE cursos SET nome = '$nome', imagem = '$imagem', descricao = '$descricao', professor = '$professor' WHERE id = $id";
    $conn->query($sql);
}

header("Location: index.php");
exit;
?>
