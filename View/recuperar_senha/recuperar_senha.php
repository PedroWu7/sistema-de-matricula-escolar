<?php
require_once __DIR__ . "/../../Utils/csrf.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar senha</title>
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
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 1rem;
    }

    .login-container {
      width: 100%;
      max-width: 400px;
      padding: 2.5rem;
      background-color: var(--card-bg-color);
      border-radius: var(--border-radius);
      box-shadow: var(--shadow-md);
      border: 1px solid var(--border-color);
    }
    
    .login-container h1 {
      font-size: 2rem;
      color: var(--dark-text);
      font-weight: 700;
      text-align: center;
      margin-bottom: 2rem;
    }
    
    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-group label {
      display: block;
      font-weight: 600;
      font-size: 0.9rem;
      color: var(--body-text);
      margin-bottom: 0.5rem;
    }
    
    .form-group input {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid var(--border-color);
      background-color: var(--bg-color);
      color: var(--dark-text);
      border-radius: 8px;
      font-size: 1rem;
      font-family: 'Inter', sans-serif;
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-group input:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(128, 90, 213, 0.25);
    }

    .btn {
      display: inline-flex; align-items: center; justify-content: center;
      width: 100%;
      gap: 0.5rem; text-decoration: none; padding: 0.75rem 1.2rem;
      border-radius: 8px; font-weight: 600; font-size: 1rem;
      border: 1px solid transparent; cursor: pointer; transition: all 0.2s ease;
    }
    .btn:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }

    .btn-fill { 
      background: linear-gradient(45deg, var(--primary-color), #9F7AEA);
      color: var(--white-color);
      box-shadow: 0 4px 10px rgba(128, 90, 213, 0.25);
    }
    .btn-fill:hover { background: linear-gradient(45deg, var(--primary-hover), #805AD5); }
    
    .btn-outline { 
      background-color: transparent; 
      color: var(--body-text); 
      border-color: var(--border-color); 
      margin-top: 1rem;
    }
    .btn-outline:hover { background-color: rgba(74, 85, 104, 0.2); border-color: var(--light-text); }

    .links-footer {
      text-align: center;
      margin-top: 1.5rem;
    }
    
    .links-footer a {
      color: var(--primary-color);
      font-size: 0.9rem;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.2s;
    }
    
    .links-footer a:hover {
      text-decoration: underline;
      color: var(--primary-hover);
    }

  </style>
</head>
<body>
    <div class="login-container">
        <form method="post" action="" id="formLogin" name="formLogin">
            <h1>Recuperar senha</h1>
            <div class="form-group">
                <label for="inputUsuario">Utilizador</label>
                <input type="text" id="inputUsuario" name="inputUsuario" required>
            </div>
            
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            
            <button type="submit" class="btn btn-fill">Recuperar</button>
            <button type="button" class="btn btn-outline" onclick="window.location.href='login'">Voltar</button>
        </form>
    </div>
</body>
</html>









