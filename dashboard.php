<?php
    session_start();
    if(!isset($_SESSION["usuario"]) || $_SESSION["usuario"] === ""){
        header("location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cursos Disponíveis</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    h1 {
      text-align: center;
    }

    .controles {
      text-align: center;
    }

    .cursos {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 20px;
      padding: 20px;
    }

    .curso {
      background-color: gray;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      position: relative;
    }
  </style>
</head>
<body>
  <p> Logado como: <?= $_SESSION["usuario"] ?> </p>
  <p> Nível da conta: <?= $_SESSION["nivel_acesso"] ?> </p>
  <h1>Cursos Disponíveis</h1>

  <div class="controles">
    <button id="adicionarCurso">Adicionar Curso</button>
    <button id="atualizarCurso">Atualizar Curso</button>
    <button id="excluirCurso">Excluir Curso</button>
  </div>

  <div class="cursos" id="cursos">
    <!-- Cursos dinâmicos aparecerão aqui -->
  </div>
  <script src="script.js"></script>
</body>
</html>
