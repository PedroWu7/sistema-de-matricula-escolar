<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Gerir Utilizadores</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-color: #805AD5;
      --primary-hover: #6B46C1;
      --danger-color: #E53E3E;
      --danger-hover: #C53030;
      
      --dark-text: #F7FAFC;
      --body-text: #E2E8F0;
      --light-text: #A0AEC0;
      
      --bg-color: #1A202C;
      --sidebar-bg: #2D3748;
      --card-bg-color: #2D3748;
      --border-color: #4A5568;
      --white-color: #FFFFFF;

      --sidebar-width: 260px;
      --border-radius: 12px;
      --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--bg-color);
      color: var(--body-text);
      line-height: 1.6;
    }

    .admin-sidebar {
      position: fixed; top: 0; left: 0;
      width: var(--sidebar-width); height: 100vh;
      background-color: var(--sidebar-bg);
      border-right: 1px solid var(--border-color);
      display: flex; flex-direction: column;
      padding: 1.5rem; transition: transform 0.3s ease;
      z-index: 1001;
    }
    .sidebar-header {
      margin-bottom: 2rem; padding-bottom: 1rem;
      border-bottom: 1px solid var(--border-color);
    }
    .sidebar-header h2 {
      color: var(--dark-text); font-size: 1.25rem; text-align: center;
    }
    .sidebar-nav { flex-grow: 1; }
    .sidebar-nav ul { list-style: none; }
    .sidebar-nav li a {
      display: flex; align-items: center; gap: 1rem;
      padding: 0.8rem 1rem; text-decoration: none;
      color: var(--light-text); font-weight: 500;
      border-radius: 8px; transition: background-color 0.2s, color 0.2s;
    }
    .sidebar-nav li a:hover,
    .sidebar-nav li a.active {
      background-color: var(--primary-color);
      color: var(--white-color);
    }

    .page-content { transition: margin-left 0.3s ease; }
    .admin-view .page-content { margin-left: var(--sidebar-width); }

    header {
      background-color: rgba(45, 55, 72, 0.85);
      padding: 1rem 2rem; border-bottom: 1px solid var(--border-color);
      position: sticky; top: 0; z-index: 999;
      backdrop-filter: saturate(180%) blur(8px);
      -webkit-backdrop-filter: saturate(180%) blur(8px);
    }
    .header-container {
      display: flex; justify-content: space-between; align-items: center;
      max-width: 1320px; margin: 0 auto;
    }
    .header-info p { font-size: 0.9rem; color: var(--light-text); }
    .header-info p span { font-weight: 600; color: var(--dark-text); }
    .header-actions { display: flex; gap: 1rem; align-items: center; }

    .btn {
      display: inline-flex; align-items: center; justify-content: center;
      gap: 0.5rem; text-decoration: none; padding: 0.6rem 1.2rem;
      border-radius: 8px; font-weight: 600; font-size: 0.9rem;
      border: 1px solid transparent; cursor: pointer; transition: all 0.2s ease;
    }
    .btn:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }
    .btn-fill { 
      background: linear-gradient(45deg, var(--primary-color), #9F7AEA); color: var(--white-color);
      box-shadow: 0 4px 10px rgba(128, 90, 213, 0.25);
    }
    .btn-fill:hover { background: linear-gradient(45deg, var(--primary-hover), #805AD5); }
    .btn-outline { background-color: transparent; color: var(--body-text); border-color: var(--border-color); box-shadow: var(--shadow-sm); }
    .btn-outline:hover { background-color: var(--sidebar-bg); border-color: var(--light-text); }

    main { padding: 2.5rem; max-width: 1320px; margin: 0 auto; }
    .page-header { margin-bottom: 2rem; }
    .page-header h1 { font-size: 2.5rem; color: var(--dark-text); font-weight: 700; margin-bottom: 0.5rem; }
    .page-header p { font-size: 1.1rem; color: var(--light-text); }
    
    .table-container {
      background-color: var(--card-bg-color);
      border-radius: var(--border-radius);
      border: 1px solid var(--border-color);
      box-shadow: var(--shadow-sm);
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 1rem 1.5rem;
      text-align: left;
      border-bottom: 1px solid var(--border-color);
    }
    
    th {
      font-size: 0.8rem;
      font-weight: 600;
      color: var(--light-text);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    td { font-size: 0.95rem; }
    td .level-admin {
      color: #F6E05E;
      font-weight: 600;
    }
    td .level-aluno {
      color: #90CDF4;
    }

    .course-tag {
      display: inline-block;
      background-color: var(--primary-color);
      color: var(--white-color);
      font-size: 0.8rem;
      font-weight: 500;
      padding: 0.25rem 0.6rem;
      border-radius: 99px;
      margin: 0.2rem;
    }

    .actions-cell {
      display: flex;
      gap: 0.75rem;
    }
    .action-btn {
      background-color: transparent;
      border: none;
      cursor: pointer;
      color: var(--light-text);
      transition: color 0.2s;
      padding: 0.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 6px;
    }
    .action-btn:hover { background-color: rgba(74, 85, 104, 0.5); }
    .action-btn.edit:hover { color: #63B3ED; }
    .action-btn.copy:hover { color: #48BB78; }
    .action-btn.remove:hover { color: var(--danger-color); }
    
    @media (max-width: 1024px) {
      .admin-sidebar { transform: translateX(-100%); }
      .admin-view .page-content { margin-left: 0; }
    }
  </style>
</head>
<body class="admin-view">

  <aside class="admin-sidebar">
    <div class="sidebar-header">
      <h2>Painel Admin</h2>
    </div>
    <nav class="sidebar-nav">
      <ul>
        <li>
          <a href="../">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5z"/><path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6z"/></svg>
            Cursos
          </a>
        </li>
        <li>
          <a href="../adicionar/curso">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg>
            Adicionar Curso
          </a>
        </li>
        <li>
          <a href="gerenciar/usuarios" class="active">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M15 14s1 0 1-1-1-4-6-4s-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/></svg>
            Gerir Utilizadores
          </a>
        </li>
      </ul>
    </nav>
  </aside>

  <div class="page-content">
    <header>
      <div class="header-container">
        <div class="header-info">
          <p>Utilizador: <span><?= htmlspecialchars($_SESSION["usuario"] ?? 'Convidado') ?></span> | Nível: <span><?= htmlspecialchars($_SESSION["nivel_acesso"] ?? 'Visitante') ?></span></p>
        </div>
        <div class="header-actions">
          <a class="btn btn-outline" href="meus-cursos">Meus Cursos</a>
          <a class="btn btn-fill" href="logout">Sair</a>
        </div>
      </div>
    </header>

    <main>
      <div class="page-header">
        <h1>Gestão de Utilizadores</h1>
        <p>Edite, copie informações ou remova utilizadores da plataforma.</p>
      </div>

      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Utilizador</th>
              <th>Nível de Acesso</th>
              <th>Cursos Matriculados</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $utilizadores = UsuarioController::listar();
              foreach ($utilizadores as $utilizador) {
            ?>
            <tr>
              <td><?= htmlspecialchars($utilizador[0]) ?></td>
              <td><?= htmlspecialchars($utilizador[1]) ?></td>
              <td><?= htmlspecialchars($utilizador[2]) ?></td>
              <td>
                <span class="level-<?= strtolower(htmlspecialchars($utilizador[4])) ?>">
                  <?= ucfirst(htmlspecialchars($utilizador[4])) ?>
                </span>
              </td>
              <td>
                <?php
                  if (!empty($utilizador[5])) {
                    $cursos = array_filter(explode(';', $utilizador[5]));
                    foreach ($cursos as $id_curso) {
                      echo '<span class="course-tag">' . htmlspecialchars($id_curso) . '</span>';
                    }
                  } else {
                    echo '<span style="color: var(--light-text);">Nenhum</span>';
                  }
                ?>
              </td>
              <td class="actions-cell">
                <a href="editar/utilizador/<?= $utilizador[0] ?>" class="action-btn edit" title="Editar">
                  <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/></svg>
                </a>
                <button class="action-btn copy" title="Copiar Informações">
                  <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/><path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zM-1 7a.5.5 0 0 1 .5-.5h15a.5.5 0 0 1 0 1h-15A.5.5 0 0 1-1 7z"/></svg>
                </button>
                <a href="remover/utilizador/<?= $utilizador[0] ?>" class="action-btn remove" title="Remover" onclick="return confirm('Tem a certeza que deseja remover este utilizador?')">
                  <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg>
                </a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>
