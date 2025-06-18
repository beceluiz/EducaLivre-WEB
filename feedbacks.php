<?php
require('conexao.php');

if (isset($_SESSION['idUsuario']) && !empty($_SESSION['idUsuario'])):
  ?>

  <!DOCTYPE html>
  <html lang="pt-br">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedbacks</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <script src="jquery-3.7.1.js"></script>
    <script src="script.js"></script>
  </head>

  <body>
    <?php require 'header.php'; ?>
    <main class="feedbacks-main">
      <div class="feedbacks-container">
        <?php
        if (isset($_GET['cadastrado']) && $_GET['cadastrado'] == 1) {
          echo "<script>alert('Avaliação registrada com sucesso!');</script>";
        }
        ?>
        <?php
        if (isset($_SESSION['idUsuario']) && !empty($_SESSION['idUsuario']) && isset($_SESSION['isAdmin']) && empty($_SESSION['isAdmin']) || $_SESSION['isAdmin'] == 0):
          echo '<div class="cadastrar-feedback"><a href="cadastra_feedback.php">Cadastrar Feedback</a></div>';
        endif;
        ?>
        <?php
        $pdo = conectar();

        try {
          $sql = $pdo->prepare("SELECT idFeedback,Usuario.nome,notaFeedback,
          textoFeedback,FORMAT(dataFeedback, 'dd/MM/yyyy') as dataFeedback
          FROM Feedback
          INNER JOIN
          Usuario
          ON
          usuario.idUsuario = feedback.idUsuario ORDER BY idFeedback DESC");
          $sql->execute();
          $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
          if (count($resultado) > 0) {
            foreach ($resultado as $indice => $conteudo) {
              echo '<div class="container-accordion">
          <div class="accordion">
            <div class="feedback-header">
              <div class="info-feedback">
                <div class="user-feedback-img">
                <img src="imgs/user.svg" alt="user">  
                </div>             
              <div class="user-name-feedback"> ' . $conteudo["nome"] . '</div>
              </div>
              <span class="nota-feedback">Nota: ' . $conteudo["notaFeedback"] . '/5</span>
              <span class="data-feedback">' . $conteudo["dataFeedback"] . '</span>
            </div>
            <div class="accordion-body active">
              <p>' . $conteudo["textoFeedback"] . '</p>
            </div>
          </div>    
        </div>';
            }
          } else {
            throw new Exception("Nenhum resultado encontrado");
          }

        } catch (Exception $erro) {
          echo "ATENÇÃO, erro na consulta: " .
            $erro->getmessage();
          ;
        }
        ?>
      </div>
    </main>
    <?php require 'footer.php'; ?>
  </body>

  </html>
  <?php
else:
  echo "<script>alert('Você precisa fazer Login para continuar!');</script>";
  header('Refresh: 1; url=login.php');
endif;
?>