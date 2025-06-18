<?php
require('conexao.php');

if(isset($_SESSION['idUsuario']) && !empty($_SESSION['idUsuario']) && isset($_SESSION['isAdmin']) && empty($_SESSION['isAdmin']) || $_SESSION['isAdmin'] == 0):

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastra Dica</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script src="jquery-3.7.1.js"></script>
    <script src="script.js"></script>
</head>
<body>
      <?php require 'header.php'; ?>
      <main>
        <div class="cadastra-feedback-main">
            <div class="cadastra-feedback-container">
                <form class="cadastra-feedback-form" action="processa_cadastra_feedback.php" method="post">
                    <label for="nota-group">Deixe sua Nota como avaliação:</label>
                    <div class="nota-group" required>
                            <div class="nota-input">
                                <input type="radio" value="1" name="nota" id="1">
                                <label for="1">1</label>
                            </div>
                            <div class="nota-input">
                                <input type="radio" value="2" name="nota" id="2">
                                <label for="2">2</label>
                            </div>
                            <div class="nota-input">
                                <input type="radio" value="3" name="nota" id="3">
                                <label for="3">3</label>
                            </div>
                            <div class="nota-input">
                                <input type="radio" value="4" name="nota" id="4">
                                <label for="4">4</label>
                            </div>
                            <div class="nota-input">
                                <input type="radio" value="5" name="nota" id="5">
                                <label for="5">5</label>
                            </div>
                        </div>
                    <label for="texto-feedbacks">Escreva sua avaliação</label>
                    <textarea rows="20" cols="50" placeholder="Digite aqui o texto da seu feedback..." name="texto-feedback" id="texto-feedback" required wrap="hard"></textarea >
                    <div class="cadastra-feedback-button-group">
                        <button type="button" class="cancela-feedback-button" onclick="redirectFeedbacks()">Cancelar</button>
                        <button type="submit" class="cadastra-feedback-button">Registrar Feedack</button>
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