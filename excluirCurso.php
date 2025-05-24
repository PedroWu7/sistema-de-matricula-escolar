<?php
session_start();
require_once "banco.php";

if ($_SESSION["nivel_acesso"] !== "administrador") {
    header("Location: index.php");
    exit;
}

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $sql = "DELETE FROM cursos WHERE id = $id";
    $conn->query($sql);
}

header("Location: index.php");
exit;
?>
