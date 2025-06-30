<?php include "protect.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="css/favicon-16x16.png" type="image/x-icon" />

  <title>Painel</title>

  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f7f7f7;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: url('css/Fundo.png') no-repeat center center fixed;
      background-size: cover;
    }

    .painel-container {
      background: white;
      background-color: transparent;
      padding: 40px;
      border-radius: 12px;
      box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px, rgba(0, 0, 0, 0.15) 0px 2px 6px 2px;
      ;
      width: 100%;
      max-width: 400px;
      text-align: center;

    }

    h2 {
      margin-bottom: 10px;
    }

    .info-user {
      margin-bottom: 20px;
      font-size: 14px;
      color: #555;
    }

    button {
      background-color: #2d89ef;
      color: white;
      border: none;
      padding: 12px 20px;
      margin: 10px 0;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
      font-size: 16px;
    }

    button:hover {
      background-color: #1b64c3;
    }

    a {
      display: block;
      margin: 8px 0;
      color: #2d89ef;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    .admin-section {
      margin-top: 20px;
      border-top: 1px solid #ddd;
      padding-top: 20px;
    }

    .logout {
      margin-top: 20px;
      padding-top: 20px;
      border-top: 1px solid #ddd;
      color: #e60000;
    }
  </style>

  <script>
    function mudarpag() {
      location.href = "contracheque.php";
    }
  </script>
</head>

<body>
  <div class="painel-container">
    <h2>Bem-vindo, <?php echo $_SESSION["nome"]; ?></h2>
    <div class="info-user">Tipo de usuário: <?php echo $_SESSION["tipo"]; ?></div>

    <button onclick="mudarpag()">Acessar Contracheque</button>
    <a href="Sobre.html">Sobre</a>
    <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin'): ?>
      <div class="admin-section">
        <h3>Funções Admin</h3>
        <a href="Cadastro.php">Cadastrar um Usuário</a>
        <a href="listar_usuarios.php">Gerenciar Usuários</a>
        <a href="document.html">Acessar Documentação</a>
      </div>
    <?php endif; ?>
    <a class="logout" href="logout.php">Sair</a>
  </div>
</body>

</html>