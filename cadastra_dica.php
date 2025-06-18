<?php
require('conexao.php');

if(isset($_SESSION['idUsuario']) && !empty($_SESSION['idUsuario']) && isset($_SESSION['isAdmin']) && !empty($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1):

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastra Dica</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script src="jquery-3.7.1.js"></script>
    <script src="script.js"></script>
</head>
<body>
      <?php require 'header.php'; ?>
      <main>
        <div class="cadastra-dica-main">
            <div class="cadastra-dica-container">
                <form class="cadastra-dica-form" action="processa_cadastra_dica.php" method="post">
                    <label for="titulo-dica">Titulo da Dica</label>
                    <input type="text" name="titulo-dica" id="titulo-dica" required>
                    <label for="texto-dica">Texto da Dica</label>
                    <textarea rows="20" cols="50" placeholder="Digite aqui o texto da sua dica..." name="texto-dica" id="texto-dica" required wrap="hard"></textarea >
                    <div class="cadastra-dica-button-group">
                        <button type="button" class="cancela-dica-button" onclick="redirectDicas()">Cancelar</button>
                        <button type="submit" class="cadastra-dica-button">Registrar Dica</button>
                    </div>
                </form>
            </div>
        </div>
      </main>
      <?php require 'footer.php'; ?>
</body>
</html>
<?php else: 
  echo "<script>alert('Você não tem permissão para acessar essa pagina!');</script>";
  header('Refresh:0; url=login.php'); 
  endif; ?>