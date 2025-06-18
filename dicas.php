<?php
require('conexao.php');

if (isset($_SESSION['idUsuario']) && !empty($_SESSION['idUsuario'])):
  ?>
  <!DOCTYPE html>
  <html lang="pt-br">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dicas</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <script src="jquery-3.7.1.js"></script>
    <script src="script.js"></script>
  </head>

  <body>
    <?php require 'header.php'; ?>
    <main>
      <div class="dicas-main">
        <div class="dicas-actions">
          <?php
          if(isset($_SESSION['idUsuario']) && !empty($_SESSION['idUsuario']) && isset($_SESSION['isAdmin']) && !empty($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1):
            echo '<div class="cadastrar-dica"><a href="cadastra_dica.php">Cadastrar Dica</a></div>';
          endif;
          ?>
          
          <div class="cadastrar-dica gerar-pdf">
            <a href="gerar_pdf_dicas.php" target="_blank" class="btn-pdf">
              📄 Gerar PDF das Dicas
            </a>
          </div>
        </div>
        
        <?php
        if (isset($_GET['cadastrada']) && $_GET['cadastrada'] == 1) {
          echo "<script>alert('Dica cadastrada com sucesso!');</script>";
        }
        ?>
        <?php
        $pdo = conectar();

        try {
          $sql = $pdo->prepare("SELECT idDica,Usuario.nome,tituloDica,
          textoDica,FORMAT(dataDica, 'dd/MM/yyyy') as dataDica
          FROM Dica
          INNER JOIN
          Usuario
          ON
          usuario.idUsuario = dica.idUsuario ORDER BY idDica DESC");
          $sql->execute();
          $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
          if (count($resultado) > 0) {
            foreach ($resultado as $indice => $conteudo) {
              echo '<div class="container-accordion">
          <div class="accordion">
            <button class="accordion-header" onclick="openAccordion(this)">
              <Span class="titulo-dica">' . $conteudo["tituloDica"] . '</Span>
              <img src="imgs/chevron-down.svg" alt="" class="chevron">
            </button>

            <div class="accordion-body">
              <p class="texto-dica">' . $conteudo["textoDica"] . '</p>
              <div class="autor-dica">
              <p>Postado por: '. $conteudo["nome"]. '</p>
              <p>Data: '. $conteudo["dataDica"]. '</p>
              </div>
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