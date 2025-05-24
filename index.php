<?php
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
  
    if (!isset($_SESSION["usuario"])) {
        $_SESSION["usuario"] = "Guest";
        $_SESSION["nivel_acesso"] = "visitante";
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cursos Disponíveis</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #ecf0f1;
      color: #2c3e50;
    }

    header {
      background-color: #2c3e50;
      color: white;
      padding: 15px 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .header-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .esquerda, .direita {
      display: flex;
      gap: 10px;
      align-items: center;
    }

    .esquerda p {
      margin: 0 10px;
      font-size: 14px;
    }

    /* Estilo para os botões do header */
    .link-header {
      display: inline-block;
      text-decoration: none;
      background-color: #3498db;
      color: white;
      padding: 8px 16px;
      border-radius: 6px;
      font-weight: bold;
      font-size: 14px;
      transition: background-color 0.3s, transform 0.2s;
    }

    .link-header:hover {
      background-color: #2980b9;
      transform: translateY(-1px);
    }

    /* Estilo para os botões dentro dos cursos */
    .link {
      display: inline-block;
      text-decoration: none;
      background-color: #18bc9c;
      color: white;
      padding: 8px 16px;
      border-radius: 6px;
      font-weight: bold;
      font-size: 14px;
      transition: background-color 0.3s, transform 0.2s;
    }

    .link:hover {
      background-color: #15a589;
      transform: translateY(-1px);
    }

    .link.excluir {
      background-color: #e74c3c;
    }

    .link.excluir:hover {
      background-color: #c0392b;
    }

    .link.atualizar {
      background-color: #3498db;
    }

    .link.atualizar:hover {
      background-color: #2980b9;
    }

    .link.participar {
      background-color: #27ae60;
    }

    .link.participar:hover {
      background-color: #1e8449;
    }

    h1 {
      text-align: center;
      margin: 30px 0 10px;
      font-size: 32px;
      color: #2c3e50;
    }

    .controles {
      text-align: center;
      margin: 30px;
    }

    .controles button {
      background-color: #2c3e50;
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
      background-color: #34495e;
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

    .curso p {
      margin-bottom: 12px;
      font-weight: 600;
      font-size: 18px;
      color: #2c3e50;
    }

    .curso img {
      width: 100%;
      height: 160px;
      object-fit: cover;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
  </style>
</head>
<body>

  <header>
    <div class="header-container">
      <div class="esquerda">
        <p>Logado como: <?= $_SESSION["usuario"] ?></p>
        <p>Nível da conta: <?= $_SESSION["nivel_acesso"] ?></p>
      </div>
      <div class="direita">
        <?php if(isset($_SESSION["usuario"]) && $_SESSION["usuario"] !== "" && $_SESSION["usuario"] !== "Guest") { ?>
          <a class="link-header" href="logout.php">Sair</a>
        <?php  } else { ?>
          <a class="link-header" href="login.php">Login</a>
          <a class="link-header" href="criarUsuario.php">Cadastrar</a>
        <?php } ?>
      </div>
    </div>
  </header>

  <?php if ($_SESSION["nivel_acesso"] === "administrador") { ?>
    <div class="controles">
      <button id="adicionarCurso" onclick="window.location.href='adicionarcurso.php'">Adicionar Curso</button>
    </div>
  <?php } ?>
    
  <h1>Cursos Disponíveis</h1>
  <div class="cursos" id="cursos">
    <?php
      require_once "banco.php";
      $cursos = listarCursos();
      foreach($cursos as $curso) { ?>
        <div class="curso">
          <p><?= $curso[1] ?></p>
          <img src="<?= $curso[2] ?>">
          <p><?= $curso[3] ?></p>
          <?php if ($_SESSION["nivel_acesso"] === "administrador") { ?>
            <a href="excluirCurso.php?id=<?= $curso[0] ?>" class="link excluir" onclick="return confirm('Tem certeza que deseja excluir este curso?')">Excluir</a>
            <a href="atualizarCurso.php?id=<?= $curso[0] ?>" class="link atualizar">Atualizar</a>
          <?php } else { ?>
            <a href="#" class="link atualizar">Ver mais</a>
            <a href="#" class="link participar">Participar</a>
          <?php } ?>
        </div>
    <?php } ?>
  </div>

  <script src="script.js"></script>
</body>
</html>
