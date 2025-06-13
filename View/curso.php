<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Detalhes do Curso</title>
  
  <!-- Fontes e Ícones -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

  <style>
    :root {
      --primary-color: #805AD5;
      --primary-hover: #6B46C1;
      
      --dark-text: #F7FAFC;
      --body-text: #E2E8F0;
      --light-text: #A0AEC0;
      
      --bg-color: #1A202C;
      --sidebar-bg: #2D3748;
      --card-bg-color: #2D3748;
      --border-color: #4A5568;
      --white-color: #FFFFFF;
      --danger-color: #E53E3E;
      --danger-hover: #C53030;

      --border-radius: 12px;
      --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--bg-color);
      color: var(--body-text);
      line-height: 1.6;
    }
    
    .page-wrapper {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
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
    .btn-outline { background-color: transparent; color: var(--body-text); border-color: var(--border-color); }
    .btn-outline:hover { background-color: var(--sidebar-bg); border-color: var(--light-text); }

    main { padding: 2.5rem; max-width: 1200px; margin: 0 auto; width: 100%; flex-grow: 1; }
    
    .course-hero {
      color: var(--dark-text);
      margin-bottom: 3rem;
    }
    .course-hero .category {
      font-size: 1rem;
      font-weight: 600;
      color: var(--primary-color);
      margin-bottom: 0.5rem;
    }
    .course-hero h1 {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 1rem;
    }
    .course-hero .subtitle {
      font-size: 1.15rem;
      color: var(--light-text);
      max-width: 800px;
    }

    .course-layout {
      display: grid;
      grid-template-columns: 1fr 350px;
      gap: 3rem;
      align-items: flex-start;
    }
    
    .course-details h2 {
      font-size: 1.75rem;
      color: var(--dark-text);
      font-weight: 600;
      margin-bottom: 1.5rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid var(--border-color);
    }
    .course-details .description {
      font-size: 1rem;
      line-height: 1.8;
      margin-bottom: 2.5rem;
    }
    
    .modules-list .module {
      margin-bottom: 0.5rem;
    }
    .module-header {
      font-size: 1.1rem;
      font-weight: 600;
      color: var(--dark-text);
      margin-bottom: 0.75rem;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.75rem;
      border-radius: 8px;
      transition: background-color 0.2s ease;
    }
    .module-header:hover {
        background-color: var(--sidebar-bg);
    }
    .module-chevron {
        transition: transform 0.3s ease;
    }
    .module-header.active .module-chevron {
        transform: rotate(180deg);
    }

    .lessons-list {
      list-style: none;
      padding-left: 1.5rem;
      border-left: 2px solid var(--border-color);
      margin-left: 0.75rem;
      overflow: hidden;
      max-height: 1000px;
      transition: max-height 0.4s ease-out, padding 0.4s ease-out, margin 0.4s ease-out;
    }
    .lessons-list.collapsed {
        max-height: 0;
        padding-top: 0;
        padding-bottom: 0;
        margin-top: 0;
    }
    .lessons-list li {
      padding: 0.5rem 0;
      color: var(--light-text);
      position: relative;
    }
    .lessons-list li::before {
      content: '';
      position: absolute;
      left: -1.5rem;
      top: 50%;
      transform: translateY(-50%);
      width: 10px;
      height: 2px;
      background-color: var(--border-color);
    }

    .course-sidebar {
      position: sticky;
      top: 120px;
    }
    .summary-card {
      background-color: var(--card-bg-color);
      border-radius: var(--border-radius);
      border: 1px solid var(--border-color);
      overflow: hidden;
    }
    .summary-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }
    .summary-content {
      padding: 1.5rem;
    }
    .summary-content .btn-fill {
      width: 100%;
      padding: 0.8rem;
      font-size: 1rem;
    }
    .summary-list {
      list-style: none;
      margin: 1.5rem 0;
    }
    .summary-list li {
      display: flex;
      justify-content: space-between;
      padding: 0.6rem 0;
      font-size: 0.95rem;
      border-bottom: 1px solid var(--border-color);
    }
    .summary-list li:last-child {
      border-bottom: none;
    }
    .summary-list li .label {
      font-weight: 500;
      color: var(--light-text);
    }
    .summary-list li .value {
      font-weight: 600;
      color: var(--dark-text);
    }

    /* ===== ESTILOS DA SEÇÃO DE COMENTÁRIOS ===== */
    .comments-section {
        margin-top: 4rem;
        padding-top: 2rem;
        border-top: 1px solid var(--border-color);
    }
    .comments-section h2 {
        font-size: 1.75rem;
        color: var(--dark-text);
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
    .comment-form {
        margin-bottom: 2.5rem;
    }
    .comment-form textarea {
        width: 100%;
        background-color: var(--sidebar-bg);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 1rem;
        color: var(--body-text);
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        resize: vertical;
        min-height: 120px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .comment-form textarea:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(128, 90, 213, 0.25);
    }
    .comment-form .form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1rem;
    }
    .comment-form .char-counter {
        font-size: 0.9rem;
        color: var(--light-text);
    }
    .comment-form button {
        margin-top: 0;
    }
    
    .comments-list .comment-card {
        background-color: var(--card-bg-color);
        padding: 1.5rem;
        border-radius: var(--border-radius);
        margin-bottom: 1.5rem;
        border: 1px solid var(--border-color);
    }
    .comments-list .comment-card:last-child {
        margin-bottom: 0;
    }
    .comment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }
    .comment-author {
        font-weight: 600;
        color: var(--dark-text);
    }
    .comment-delete-btn {
        background-color: transparent;
        border: none;
        color: var(--light-text);
        cursor: pointer;
        font-size: 0.9rem;
        padding: 0.5rem;
        border-radius: 6px;
        transition: color 0.2s, background-color 0.2s;
    }
    .comment-delete-btn:hover {
        color: var(--danger-color);
        background-color: rgba(229, 62, 62, 0.1);
    }
    .comment-body {
        font-size: 1rem;
        color: var(--body-text);
        white-space: pre-wrap;
    }

    footer {
      text-align: center;
      padding: 3rem 2rem;
      margin-top: 4rem;
      color: var(--light-text);
      font-size: 0.9rem;
      border-top: 1px solid var(--border-color);
    }

    @media (max-width: 992px) {
      .course-layout {
        grid-template-columns: 1fr;
      }
      .course-sidebar {
        position: static;
        margin-top: 3rem;
      }
    }
    @media (max-width: 768px) {
      main { padding: 1.5rem; }
      .course-hero h1 { font-size: 2.2rem; }
    }
  </style>
</head>
<body>
<div class="page-wrapper">
  <header>
    <div class="header-container">
      <div class="header-info">
        <p>Utilizador: <span><?= htmlspecialchars($_SESSION["usuario"] ?? 'Convidado') ?></span> | Nível: <span><?= htmlspecialchars($_SESSION["nivel_acesso"] ?? 'Visitante') ?></span></p>
      </div>
      <div class="header-actions">
        <a class="btn btn-outline" href="../../"><i class="fas fa-arrow-left"></i> Voltar</a>
        <a class="btn btn-fill" href="../../logout">Sair <i class="fas fa-sign-out-alt"></i></a>
      </div>
    </div>
  </header>

  <main>
    <?php
    require_once __DIR__ . "/../Controller/CursoController.php";
    require_once __DIR__ . "/../Controller/ComentarioController.php";
    require_once __DIR__ . "/../Model/Comentario.php";
    $curso = CursoController::ver();
    $_SESSION["curso"] = $curso;
    ?>

    <section class="course-hero">
      <p class="category">Desenvolvimento Web</p>
      <h1><?= htmlspecialchars($curso['nome']) ?></h1>
      <p class="subtitle">Aprenda a construir interfaces de utilizador modernas e reativas com a biblioteca mais popular do mercado.</p>
    </section>

    <div class="course-layout">
      <div class="course-details">
        <h2>Sobre este Curso</h2>
        <p class="description">
          Neste curso abrangente, você mergulhará fundo no ecossistema React. Começaremos com os conceitos fundamentais como JSX, componentes, estado e props, e avançaremos progressivamente para tópicos complexos, incluindo a gestão de estado com Context API e Redux, roteamento com React Router, e testes de componentes. Ao final, você será capaz de projetar e construir aplicações web robustas, escaláveis e de alta performance.
        </p>

        <h2>O que irá aprender</h2>
        <div class="modules-list">
          <div class="module">
            <h3 class="module-header" data-target="#module-1-lessons">
                <span>Módulo 1: Fundamentos do React</span>
                <i class="fas fa-chevron-down module-chevron"></i>
            </h3>
            <ul class="lessons-list" id="module-1-lessons">
              <li>Introdução ao JSX</li>
              <li>Componentes e Props</li>
              <li>Estado e Ciclo de Vida</li>
            </ul>
          </div>
          <div class="module">
            <h3 class="module-header" data-target="#module-2-lessons">
                <span>Módulo 2: Hooks e Tópicos Avançados</span>
                <i class="fas fa-chevron-down module-chevron"></i>
            </h3>
            <ul class="lessons-list" id="module-2-lessons">
              <li>useState e useEffect</li>
              <li>useContext e custom Hooks</li>
              <li>Performance e Otimização</li>
            </ul>
          </div>
        </div>

        <!-- SEÇÃO DE COMENTÁRIOS -->
        <?php if(($_SESSION['nivel_acesso'] ?? 'visitante') !== "visitante"){?>
          <div class="comments-section">
            <h2>Comentários</h2>
    
            <form method="POST" action="" class="comment-form">
              <textarea id="comment-textarea" name="comentario" rows="4" placeholder="Escreva seu comentário aqui..." required maxlength="500"></textarea>
              <div class="form-footer">
                  <button type="submit" class="btn btn-fill">
                      <i class="fas fa-paper-plane"></i> Enviar Comentário
                  </button>
              </div>
            </form>
    
            <?php 
              $comentarios = ComentarioController::listarPorCurso(); 
            ?>
            <div class="comments-list">
              <?php if (!empty($comentarios)): ?>
                <?php foreach ($comentarios as $comentario): ?>
                  <div class="comment-card">
                    <div class="comment-header">
                      <p class="comment-author"><?= htmlspecialchars($comentario[2]) ?></p>
                      
                      <?php if (($_SESSION['nivel_acesso'] ?? '') !== 'visitante') { ?>
                        <a href="../../excluir-comentario/<?= $comentario[0] ?>" 
                           class="comment-delete-btn" 
                           title="Excluir comentário" 
                           onclick="return confirm('Tem certeza de que deseja excluir este comentário?');">
                           <i class="fas fa-trash"></i>
                        </a>
                      <?php } ?>
                      
                    </div>
                    <p class="comment-body"><?= nl2br(htmlspecialchars($comentario[3])) ?></p>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <p>Seja o primeiro a comentar!</p>
              <?php endif; ?>
            </div>
          </div>
        <?php } else { ?>
            <div class="comments-section">
                <h2>Comentários</h2>
                <p>Você precisa <a href="../../login" style="color: var(--primary-color);">fazer login</a> para ver e deixar comentários.</p>
            </div>
        <?php } ?>
      </div>

      <aside class="course-sidebar">
        <div class="summary-card">
          <img src="<?= htmlspecialchars($curso['imagem']) ?>" alt="Banner do curso">
          <div class="summary-content">
            <a href="../../participar/curso/<?= htmlspecialchars($curso['id'] ?? 0) ?>" class="btn btn-fill">
              <i class="fas fa-check"></i> Participar no Curso
            </a>
            <ul class="summary-list">
              <li>
                <span class="label">Nível</span>
                <span class="value">Iniciante</span>
              </li>
              <li>
                <span class="label">Duração</span>
                <span class="value">24 horas</span>
              </li>
              <li>
                <span class="label">Certificado</span>
                <span class="value">Não</span>
              </li>
            </ul>
          </div>
        </div>
      </aside>
    </div> 
  </main>

  <footer>
    <p>&copy; <?= date("Y") ?> Vértice Academy Inc. Todos os direitos reservados.</p>
  </footer>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Lógica para módulos expansíveis (collapsible)
    const moduleHeaders = document.querySelectorAll('.module-header');
    
    // Deixa todos os módulos fechados por defeito, exceto o primeiro
    moduleHeaders.forEach((header, index) => {
        const content = document.querySelector(header.dataset.target);
        if (content) {
            if (index === 0) {
                header.classList.add('active');
            } else {
                content.classList.add('collapsed');
            }
        }
        
        header.addEventListener('click', () => {
            header.classList.toggle('active');
            if (content) {
                content.classList.toggle('collapsed');
            }
        });
    });
});
</script>

</body>
</html>
