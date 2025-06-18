<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar Senha</title>
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
  <script src="jquery-3.7.1.js"></script>
  <script src="script.js"></script>
</head>
<body>
  <?php require 'header.php'; ?>
  <main>
    <div class="cadastra-dica-main">
      <div class="cadastra-dica-container">

        <?php
          // Mensagens de feedback
          if (isset($_GET['notfound']) && $_GET['notfound'] == 1) {
            echo "<script>alert('Usuario não encontrado na nossa base de dados!');</script>";
          }
          if (isset($_GET['sent']) && $_GET['sent'] == 1) {
            echo "<script>alert('Enviamos um link de recuperação para o seu E-mail!');</script>";
          }
          if (isset($_GET['error']) && $_GET['error'] == 'empty') {
            echo "<script>alert('Por favor, Informe seu E-Mail!');</script>";;
          }
          if (isset($_GET['expired']) && $_GET['expired'] == 1) {
            echo "<script>alert('Token Invalido ou Expirado!');</script>";
          }
        ?>

        <form class="cadastra-dica-form" action="processa_esqueci_minha_senha.php" method="post">
          <label for="email-recuperacao">Digite seu endereço de e‑mail</label>
          <input
            type="email"
            name="email-recuperacao"
            id="email-recuperacao"
            placeholder="seu@exemplo.com"
            required
          >
          <div class="cadastra-dica-button-group">
            <button type="button" class="cancela-dica-button" onclick="redirectLogin()">Cancelar</button>
            <button type="submit" class="cadastra-dica-button">Recuperar senha</button>
          </div>
        </form>
      </div>
    </div>
  </main>
  <?php require 'footer.php'; ?>
</body>
</html>
