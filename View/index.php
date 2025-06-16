<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cursos Disponíveis</title>
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
      --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--bg-color);
      color: var(--body-text);
      line-height: 1.6;
    }

    .admin-sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: var(--sidebar-width);
      height: 100vh;
      background-color: var(--sidebar-bg);
      border-right: 1px solid var(--border-color);
      display: flex;
      flex-direction: column;
      padding: 1.5rem;
      transition: transform 0.3s ease;
      z-index: 1001;
    }
    .sidebar-header {
      margin-bottom: 2rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid var(--border-color);
    }
    .sidebar-header h2 {
      color: var(--dark-text);
      font-size: 1.25rem;
      text-align: center;
    }
    .sidebar-nav {
      flex-grow: 1;
    }
    .sidebar-nav ul {
      list-style: none;
    }
    .sidebar-nav li a {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 0.8rem 1rem;
      text-decoration: none;
      color: var(--light-text);
      font-weight: 500;
      border-radius: 8px;
      transition: background-color 0.2s, color 0.2s;
    }
    .sidebar-nav li a:hover,
    .sidebar-nav li a.active {
      background-color: var(--primary-color);
      color: var(--white-color);
    }

    .page-content {
      transition: margin-left 0.3s ease;
    }
    .admin-view .page-content {
        margin-left: var(--sidebar-width);
    }

    header {
      background-color: rgba(45, 55, 72, 0.85);
      padding: 1rem 2rem;
      border-bottom: 1px solid var(--border-color);
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
    .btn-danger { background-color: var(--danger-color); color: var(--white-color); }
    .btn-danger:hover { background-color: var(--danger-hover); }

    main { padding: 2rem; max-width: 1320px; margin: 0 auto; }
    .hero-section { text-align: center; margin: 2rem auto 4rem; }
    .hero-section h1 { font-size: 3.2rem; color: var(--dark-text); font-weight: 700; margin-bottom: 1rem; }
    .hero-section .subtitle { font-size: 1.15rem; color: var(--light-text); max-width: 650px; margin: 0 auto; }
    
    .filters-section {
      background-color: var(--card-bg-color); padding: 1.5rem; border-radius: var(--border-radius);
      box-shadow: var(--shadow-sm); margin-bottom: 4rem; display: flex;
      flex-wrap: wrap; gap: 1.5rem; align-items: flex-end; border: 1px solid var(--border-color);
    }
    .filter-group { display: flex; flex-direction: column; gap: 0.5rem; flex-grow: 1; }
    .filter-group label { font-weight: 600; font-size: 0.9rem; color: var(--dark-text); }
    .filter-group input, .filter-group select {
      padding: 0.75rem; border: 1px solid var(--border-color); background-color: var(--bg-color);
      color: var(--dark-text); border-radius: 8px; font-size: 1rem; font-family: 'Inter', sans-serif;
      width: 100%; min-width: 200px; transition: border-color 0.2s, box-shadow 0.2s;
    }
    .filter-group input:focus, .filter-group select:focus {
      outline: none; border-color: var(--primary-color); box-shadow: 0 0 0 3px rgba(128, 90, 213, 0.25);
    }

    .cursos-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2.5rem; }
    .curso-card {
      background-color: var(--card-bg-color); border-radius: 16px; box-shadow: var(--shadow-md);
      display: flex; flex-direction: column; overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease; border: 1px solid var(--border-color);
    }
    .curso-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); }
    .card-banner { position: relative; }
    .card-banner img { width: 100%; height: 200px; object-fit: cover; }
    .card-content { padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1; }
    .category-tag { font-size: 0.8rem; font-weight: 600; margin-bottom: 0.75rem; color: var(--primary-color); }
    .card-content h3 { font-size: 1.25rem; color: var(--dark-text); font-weight: 600; margin-bottom: 0.5rem; }
    .card-content .description { font-size: 0.95rem; margin-bottom: 1rem; flex-grow: 1; color: var(--light-text); }
    .card-footer {
      border-top: 1px solid var(--border-color); padding: 1rem 1.5rem; margin-top: auto;
      display: flex; justify-content: space-between; align-items: center;
    }
    .card-actions { display: flex; gap: 0.75rem; }
    .card-actions .btn { padding: 0.5rem 1rem; font-size: 0.85rem; }
    
    .empty-state {
        display: none; text-align: center; padding: 4rem 2rem;
        background-color: var(--card-bg-color); border: 1px solid var(--border-color);
        border-radius: var(--border-radius); box-shadow: var(--shadow-sm);
    }
    .empty-state svg { width: 60px; height: 60px; color: var(--light-text); margin-bottom: 1.5rem; }
    .empty-state h3 { font-size: 1.5rem; color: var(--dark-text); margin-bottom: 0.5rem; }
    .empty-state p { color: var(--body-text); }

    footer { text-align: center; padding: 3rem 2rem; margin-top: 4rem; color: var(--light-text); font-size: 0.9rem; }
    
    @media (max-width: 1024px) {
      .admin-sidebar { transform: translateX(-100%); }
      .admin-view .page-content { margin-left: 0; }
    }
  </style>
</head>
<body class="<?= (isset($_SESSION["nivel_acesso"]) && $_SESSION["nivel_acesso"] === "administrador") ? 'admin-view' : '' ?>">

  <?php if (isset($_SESSION["nivel_acesso"]) && $_SESSION["nivel_acesso"] === "administrador") { ?>
    <aside class="admin-sidebar">
      <div class="sidebar-header">
        <h2>Painel Admin</h2>
      </div>
      <nav class="sidebar-nav">
        <ul>
          <li>
            <a href="adicionar/curso" class="active">
              <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg>
              Adicionar Curso
            </a>
          </li>
          <li>
            <a href="gerenciar/usuarios">
              <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M15 14s1 0 1-1-1-4-6-4s-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/></svg>
              Gerir Utilizadores
            </a>
          </li>
        </ul>
      </nav>
    </aside>
  <?php } ?>

  <div class="page-content">
    <header>
      <div class="header-container">
        <div class="header-info">
          <p>Utilizador: <span><?= htmlspecialchars($_SESSION["usuario"] ?? 'Convidado') ?></span> | Nível: <span><?= htmlspecialchars($_SESSION["nivel_acesso"] ?? 'Visitante') ?></span></p>
        </div>
        <div class="header-actions">
          <?php include __DIR__ . "/templates/header.php"; ?>
        </div>
      </div>
    </header>

    <main>
      <section class="hero-section">
          <h1>Vértice Academy</h1>
          <p class="subtitle">O seu próximo passo profissional começa aqui. Explore cursos criados por especialistas e acelere a sua carreira.</p>
      </section>

      <section class="filters-section">
        <div class="filter-group">
            <label for="search">Pesquisar por nome</label>
            <input type="text" id="search" placeholder="Ex: Marketing, Python, Design...">
        </div>
        <div class="filter-group">
            <label for="category">Filtrar por categoria</label>
            <select id="category">
                <option value="todos">Todas as Categorias</option>
                <option value="tecnologia">Tecnologia</option>
                <option value="negocios">Negócios</option>
                <option value="design">Design</option>
            </select>
        </div>
        <div class="filter-group">
            <button class="btn btn-outline" id="clear-filters">Limpar Filtros</button>
        </div>
      </section>
      
      <div class="cursos-grid" id="cursos">
        <?php
          // Bloco PHP para listar os cursos foi restaurado aqui
          $cursos = Curso::listar();
          foreach($cursos as $curso) { 
        ?>
          <div class="curso-card" data-name="<?= htmlspecialchars($curso[1]) ?>" data-category="geral">
            <div class="card-banner">
              <img src="<?= htmlspecialchars($curso[2]) ?>" alt="Imagem do curso <?= htmlspecialchars($curso[1]) ?>">
            </div>
            <div class="card-content">
              <p class="category-tag">Geral</p>
              <h3><?= htmlspecialchars($curso[1]) ?></h3>
              <p class="description"><?= htmlspecialchars($curso[3]) ?></p>
            </div>
            <div class="card-footer">
              <div class="card-actions">
                <?php if (isset($_SESSION["nivel_acesso"]) && $_SESSION["nivel_acesso"] === "administrador") { ?>
                  <a href="excluir/curso/<?= $curso[0] ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este curso?')">Excluir</a>
                  <a href="atualizar/curso/<?= $curso[0] ?>" class="btn btn-outline">Editar</a>
                <?php } else { ?>
                  <a href="ver/curso/<?= $curso[0] ?>" class="btn btn-outline">Ver mais</a>
                  <?php
                    if(Curso::usuarioInscritoCurso($curso[0], $_SESSION["usuario"])){ ?>
                      <a href="sair/curso/<?= $curso[0] ?>" class="btn btn-danger">Sair do curso</a>
                    <?php } else {?>
                        <a href="participar/curso/<?= $curso[0] ?>" class="btn btn-fill">Participar</a>
                  <?php } ?>
                <?php } ?>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    
      <div class="empty-state" id="empty-state">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
        <h3>Nenhum curso encontrado</h3>
        <p>Tente ajustar os termos da sua pesquisa ou limpar os filtros.</p>
      </div>
    </main>

    <footer>
      <p>&copy; <?= date("Y") ?> Vértice Academy Inc. Todos os direitos reservados.</p>
    </footer>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const categorySelect = document.getElementById('category');
        const clearButton = document.getElementById('clear-filters');
        const coursesGrid = document.getElementById('cursos');
        const courseCards = coursesGrid.querySelectorAll('.curso-card');
        const emptyState = document.getElementById('empty-state');

        function filterCourses() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedCategory = categorySelect.value;
            let visibleCourses = 0;

            if (courseCards.length === 0) {
                coursesGrid.style.display = 'none';
                emptyState.style.display = 'block';
                return;
            }

            courseCards.forEach(card => {
                const name = card.dataset.name.toLowerCase();
                const category = card.dataset.category;

                const nameMatch = name.includes(searchTerm);
                const categoryMatch = (selectedCategory === 'todos') || (category === selectedCategory);

                if (nameMatch && categoryMatch) {
                    card.style.display = 'flex';
                    visibleCourses++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (visibleCourses === 0) {
                coursesGrid.style.display = 'none';
                emptyState.style.display = 'block';
            } else {
                coursesGrid.style.display = 'grid';
                emptyState.style.display = 'none';
            }
        }

        function clearAllFilters() {
            searchInput.value = '';
            categorySelect.value = 'todos';
            filterCourses();
        }
        
        filterCourses();

        searchInput.addEventListener('input', filterCourses);
        categorySelect.addEventListener('change', filterCourses);
        clearButton.addEventListener('click', clearAllFilters);
    });
  </script>

</body>
</html>
