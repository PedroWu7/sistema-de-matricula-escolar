<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sobre Nós</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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

      --border-radius: 12px;
      --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

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

    main { padding: 2.5rem; max-width: 1000px; margin: 0 auto; width: 100%; flex-grow: 1; }
    
    .page-header {
      text-align: center;
      margin-bottom: 4rem;
    }
    .page-header h1 {
      font-size: 3rem;
      font-weight: 700;
      color: var(--dark-text);
      margin-bottom: 1rem;
    }
    .page-header .subtitle {
      font-size: 1.15rem;
      color: var(--light-text);
      max-width: 700px;
      margin: 0 auto;
    }

    .content-section {
      margin-bottom: 4rem;
    }
    .content-section h2 {
      font-size: 2rem;
      font-weight: 600;
      color: var(--dark-text);
      margin-bottom: 1.5rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid var(--border-color);
    }
    .content-section p {
      font-size: 1rem;
      line-height: 1.8;
      max-width: 800px;
    }

    .team-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 2rem;
    }
    .team-member-card {
      background-color: var(--card-bg-color);
      border-radius: var(--border-radius);
      border: 1px solid var(--border-color);
      text-align: center;
      padding: 2rem;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .team-member-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-md);
    }
    .team-member-card img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 1.5rem;
      border: 3px solid var(--primary-color);
    }
    .team-member-card h3 {
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--dark-text);
      margin-bottom: 0.25rem;
    }
    .team-member-card .role {
      font-size: 0.9rem;
      font-weight: 500;
      color: var(--primary-color);
    }

    footer {
      text-align: center;
      padding: 3rem 2rem;
      margin-top: 4rem;
      color: var(--light-text);
      font-size: 0.9rem;
      border-top: 1px solid var(--border-color);
    }

    @media (max-width: 768px) {
      main { padding: 1.5rem; }
      .page-header h1 { font-size: 2.2rem; }
      .content-section h2 { font-size: 1.75rem; }
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
    <section class="page-header">
      <h1>Sobre a Nossa Plataforma</h1>
      <p class="subtitle">A nossa missão é democratizar o acesso à educação de qualidade, capacitando pessoas para alcançarem os seus objetivos profissionais e pessoais.</p>
    </section>

    <section class="content-section">
      <h2>A Nossa História</h2>
      <p>
        Fundada em 2025, a nossa plataforma nasceu da visão de que o conhecimento é a ferramenta mais poderosa para a transformação. Começamos com uma pequena equipe de educadores e tecnólogos apaixonados por criar uma experiência de aprendizagem flexível, acessível e eficaz. Hoje, orgulhamo-nos de servir milhares de estudantes, oferecendo um catálogo de cursos em constante crescimento nas áreas mais relevantes do mercado.
      </p>
    </section>

    <section class="content-section">
      <h2>A Nossa Equipe</h2>
      <div class="team-grid">
        <div class="team-member-card">
          <img src="https://i.imgur.com/E3OU8VW.png" alt="Foto de um membro da equipa">
          <h3>Kaue Spacki</h3>
          <p class="role">Dev</p>
        </div>
        <div class="team-member-card">
          <img src="https://i.imgur.com/k5E4PEO.jpeg" alt="Foto de um membro da equipa">
          <h3>Pedro Wu</h3>
          <p class="role">Dev</p>
        </div>
        <div class="team-member-card">
          <img src="https://i.imgur.com/ILugS5U.jpeg" alt="Foto de um membro da equipa">
          <h3>Emanuel Galindo</h3>
          <p class="role">Dev</p>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; <?= date("Y") ?> Plataforma de Cursos Inc. Todos os direitos reservados.</p>
  </footer>
</div>
</body>
</html>
