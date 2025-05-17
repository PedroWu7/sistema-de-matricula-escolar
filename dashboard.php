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
  <header>
    <p> Logado como: <?= $_SESSION["usuario"] ?> </p>
    <p> Nível da conta: <?= $_SESSION["nivel_acesso"] ?> </p>
  </header>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f2f5;
      color: #333;
    }

    header {
      background-color:rgb(41, 68, 87);
      color: white;
      padding: 15px 20px;
      text-align: center;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    header p {
      margin: 5px 0;
      font-size: 16px;
    }

    h1 {
      text-align: center;
      margin: 30px 0 10px;
      font-size: 32px;
      color: rgb(41, 68, 87);
    }

    .controles {
      text-align: center;
      margin-bottom: 30px;
    }

    .controles button {
      background-color: rgb(41, 68, 87);
      color: white;
      border: none;
      padding: 12px 24px;
      margin: 8px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s, transform 0.2s;
    }

    .controles button:hover {
      background-color:rgb(43, 79, 104);
      transform: translateY(-2px);
    }

    .cursos {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
      gap: 20px;
      padding: 20px;
      max-width: 1200px;
      margin: 0 auto 40px;
    }

    .curso {
      background-color: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      text-align: center;
      transition: transform 0.2s, box-shadow 0.3s;
    }

    .curso:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
    }

    .curso p, a {
      margin-bottom: 12px;
      font-weight: 600;
      font-size: 18px;
      color: rgb(41, 68, 87);
    }

    .link {
      text-decoration: none;
      color: rgb(0, 153, 255);
      padding-left: 10px;
    }

    .curso img {
      width: 100%;
      height: 160px;
      object-fit: cover;
      border-radius: 8px;
      border: 1px solid #ddd;
    }
  </style>
  <?php if($_SESSION["nivel_acesso"] === "administrador"){ ?>
    <div class="controles">
      <button id="adicionarCurso">Adicionar Curso</button>
    </div>
  <?php } ?>

  <div class="cursos" id="cursos">
    <?php
    require_once "banco.php";
      $cursos = listarCursos();
      foreach($cursos as $curso){ ?>
        <div class="curso">
          <p> <?=$curso["nome"]?></p>
          <img src="<?= $curso["imagem"]?>">
          <p> <?=$curso["descricao"]?></p>
          <?php 
            if($_SESSION["nivel_acesso"] === "administrador"){ ?>
              <a href="#" class="link">Excluir</a>
              <a href="#" class="link">Atualizar</a>
            <?php } else { ?>
              <a href="#" class="link">Participar</a>
            <?php }
          ?>
        </div>
      <?php }
    ?>
  </div>
  <script src="script.js"></script>
</body>
</html>
