<?php
require_once __DIR__ . "/../Utils/csrf.php";
?>

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
    .btn-danger { 
      background: linear-gradient(45deg, var(--danger-color), #C53030); color: var(--white-color);
      box-shadow: 0 4px 10px rgba(213, 90, 106, 0.25);
    }
    .btn-fill:hover { background: linear-gradient(45deg, var(--primary-hover), #805AD5); }
    .btn-danger:hover { background: linear-gradient(45deg, var(--danger-hover), #C53030); }
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

    .summary-content .btn-danger {
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

    /* ESTILOS DA SEÇÃO DE COMENTÁRIOS */
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
      font-size: 0.85rem;
      border-top: 1px solid var(--border-color);
      background-color: rgba(45, 55, 72, 0.85);
      backdrop-filter: saturate(180%) blur(8px);
      -webkit-backdrop-filter: saturate(180%) blur(8px);
    }

    /* Botões dentro do comentário */
    .comment-actions {
      display: flex;
      gap: 0.5rem;
    }

    .comment-edit-btn,
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

    .comment-edit-btn:hover {
      color: var(--primary-color);
      background-color: rgba(128, 90, 213, 0.1);
    }

    .comment-delete-btn:hover {
      color: var(--danger-color);
      background-color: rgba(229, 62, 62, 0.1);
    }

    /* Formulário de edição inline do comentário */
    .comment-edit-form textarea {
      width: 100%;
      background-color: var(--sidebar-bg);
      border: 1px solid var(--border-color);
      border-radius: 8px;
      padding: 1rem;
      color: var(--body-text);
      font-family: 'Inter', sans-serif;
      font-size: 1rem;
      resize: vertical;
      min-height: 100px;
      margin-top: 0.5rem;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .comment-edit-form textarea:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(128, 90, 213, 0.25);
    }
    .comment-edit-form .form-buttons {
      margin-top: 0.5rem;
      display: flex;
      gap: 0.5rem;
    }
    .btn-save {
      background-color: var(--primary-color);
      color: var(--white-color);
      border: none;
      padding: 0.5rem 1.2rem;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      transition: background-color 0.2s;
    }
    .btn-save:hover {
      background-color: var(--primary-hover);
    }
    .btn-cancel {
      background-color: transparent;
      border: 1px solid var(--light-text);
      color: var(--light-text);
      padding: 0.5rem 1.2rem;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      transition: background-color 0.2s, color 0.2s;
    }
    .btn-cancel:hover {
      background-color: var(--light-text);
      color: var(--bg-color);
      border-color: var(--light-text);
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
          <?php include __DIR__ . "/templates/header.php"; ?>  
      </div>
    </div>
  </header>

  <main>
    <?php
    $curso = CursoController::ver();
    $_SESSION["curso"] = $curso;
    ?>

    <section class="course-hero">
      <h1><?= htmlspecialchars($curso['nome']) ?></h1>
    </section>

    <div class="course-layout">
      <div class="course-details">
        <h2>Sobre este Curso</h2>
        <p class="description">
          <?= $curso["descricao"] ?>
        </p>

        <!-- SEÇÃO DE COMENTÁRIOS -->
        <?php if(($_SESSION['nivel_acesso'] ?? 'visitante') !== "visitante"){?>
          <div class="comments-section">
            <h2>Comentários</h2>
    
            <form method="POST" action="" class="comment-form">
              <textarea id="comment-textarea" name="comentario" rows="4" placeholder="Escreva seu comentário aqui..." required maxlength="500"></textarea>
              <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
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
                  <div class="comment-card" data-comentario-id="<?= $comentario[0] ?>">
                    <div class="comment-header">
                      <p class="comment-author"><?= htmlspecialchars($comentario[2]) ?></p>

                      <?php if (($_SESSION['nivel_acesso'] ?? '') !== 'visitante') { ?>
                        <div class="comment-actions">
                          <!-- Botão Editar -->
                          <button type="button" class="comment-edit-btn" title="Editar comentário">
                            <i class="fas fa-edit"></i>
                          </button>

                          <!-- Botão Excluir -->
                          <a href="../../excluir/comentario/<?= $comentario[0] ?>"
                             class="comment-delete-btn"
                             title="Excluir comentário"
                             onclick="return confirm('Tem certeza de que deseja excluir este comentário?');">
                             <i class="fas fa-trash"></i>
                          </a>
                        </div>
                      <?php } ?>
                    </div>

                    <!-- Texto do comentário em um parágrafo -->
                    <p class="comment-body"><?= nl2br(htmlspecialchars($comentario[3])) ?></p>

                    <!-- Formulário de edição escondido -->
                    <form method="POST" action="../../editar/comentario/<?= $comentario[0] ?>" class="comment-edit-form" style="display:none;">
                      <textarea name="comentario" rows="4" maxlength="500"><?= htmlspecialchars($comentario[3]) ?></textarea>
                      <input type="hidden" name="comentario_id" value="<?= $comentario[0] ?>">
                      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                      <div class="form-buttons">
                        <button type="submit" class="btn-save">Salvar</button>
                        <button type="button" class="btn-cancel">Cancelar</button>
                      </div>
                    </form>
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
            <?php
            if(Curso::usuarioInscritoCurso($curso["id"], $_SESSION["usuario"])){ ?>
              <a href="./../../sair/curso/<?= $curso["id"] ?>" class="btn btn-danger">Sair do curso</a>
            <?php } else { ?>
              <a href="./../../participar/curso/<?= $curso["id"] ?>" class="btn btn-fill">Participar</a>
            <?php } ?>
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
  const comments = document.querySelectorAll('.comment-card');

  comments.forEach(commentCard => {
    const editBtn = commentCard.querySelector('.comment-edit-btn');
    const deleteBtn = commentCard.querySelector('.comment-delete-btn');
    const commentBody = commentCard.querySelector('.comment-body');
    const editForm = commentCard.querySelector('.comment-edit-form');
    const cancelBtn = editForm.querySelector('.btn-cancel');

    editBtn.addEventListener('click', () => {
      commentBody.style.display = 'none';
      editForm.style.display = 'block';
      editBtn.style.display = 'none';
      if(deleteBtn) deleteBtn.style.display = 'none';
    });

    cancelBtn.addEventListener('click', () => {
      commentBody.style.display = 'block';
      editForm.style.display = 'none';
      editBtn.style.display = 'inline-block';
      if(deleteBtn) deleteBtn.style.display = 'inline-block';
    });
  });

  // módulos expansíveis (se tiver essa parte)
  const moduleHeaders = document.querySelectorAll('.module-header');
  moduleHeaders.forEach((header, index) => {
    const content = document.querySelector(header.dataset.target);
    if(content){
      if(index === 0){
        header.classList.add('active');
      } else {
        content.classList.add('collapsed');
      }

      header.addEventListener('click', () => {
        header.classList.toggle('active');
        content.classList.toggle('collapsed');
      });
    }
  });

  // contador de caracteres no textarea do comentário
  const commentTextarea = document.getElementById('comment-textarea');
  if(commentTextarea){
    const formFooter = commentTextarea.closest('form').querySelector('.form-footer');
    const counter = document.createElement('div');
    counter.className = 'char-counter';
    counter.textContent = `0 / ${commentTextarea.maxLength}`;
    formFooter.insertBefore(counter, formFooter.firstChild);

    commentTextarea.addEventListener('input', () => {
      counter.textContent = `${commentTextarea.value.length} / ${commentTextarea.maxLength}`;
    });
  }
});
</script>

</body>
</html>
