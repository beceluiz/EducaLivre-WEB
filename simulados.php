<?php
require('conexao.php');

if (isset($_SESSION['idUsuario']) && !empty($_SESSION['idUsuario'])):
  ?>
  <!DOCTYPE html>
  <html lang="pt-br">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulados</title>
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <script src="jquery-3.7.1.js"></script>
    <script src="script.js"></script>
  </head>

  <body>
    <?php require 'header.php'; ?>
    <main>
        <div class="simulados-main">
            <div class="container-accordion">
                <p class="area-de-estudo">Provas Anteriores</p>
                <div class="accordion">
                <button class="accordion-header" onclick="openAccordion(this)">
                <Span class="ano-prova">Sobre</Span>
                <img src="imgs/chevron-down.svg" alt="" class="chevron">
                </button>

            <div class="accordion-body">
              <p class="texto-dica">Desde 2009, o Enem é composto por quatro provas objetivas,
                 com 45 questões cada,
                 e uma redação. As provas são estruturadas em quatro
                <a id="matriz-referencia" href="https://download.inep.gov.br/download/enem/matriz_referencia.pdf" target="_blank">
                  matrizes de referência</a>, uma para cada área de conhecimento. Há um caderno de questões para cada dia de aplicação. Entre 1998 e 2008, 
                  as provas eram estruturadas a partir de uma matriz de 21 habilidades, cada uma delas avaliada por três questões. Assim, a parte objetiva era composta por uma redação e 63 itens interdisciplinares, em um único caderno
                  .Conheça as provas e os gabaritos das edições anteriores do Enem.<p>
            </div>
          </div>    
                <?php
                $pdo = conectar();
                $tabela = "provasAnteriores";

                try {
                    $sql = $pdo->prepare("SELECT * FROM $tabela ORDER BY anoProva DESC, diaProva ASC");
                    $sql->execute();
                    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

                    if (count($resultado) > 0) {
                        $anoAtual = null;

                        foreach ($resultado as $conteudo) {
                            if ($anoAtual !== $conteudo["anoProva"]) {

                                if ($anoAtual !== null) {
                                    echo '</div>';
                                    echo '</div>'; 
                                }

                                $anoAtual = $conteudo["anoProva"];
                                echo '<div class="accordion">
                                    <button class="accordion-header" onclick="openAccordion(this)">
                                        <span class="ano-prova">' . $anoAtual . '</span>
                                        <img src="imgs/chevron-down.svg" alt="" class="chevron">
                                    </button>
                                    <div class="accordion-body">';
                            }
                                $caminho = "provas/" . $conteudo["anoProva"] . "/";

                            echo '<ul class="accordion-provas-gabaritos-list">
                                    <p class="dia"> Dia ' . $conteudo["diaProva"] . ':</p>
                                  <li class="link-prova"><a href="' . $caminho . $conteudo["nomeArquivoProva"] . '" target="_blank">Prova</a></li>'; 

                            if (!empty($conteudo["nomeArquivoGabarito"])) {
                                echo '<li class="link-prova"><a href="' . $caminho . $conteudo["nomeArquivoGabarito"] . '" target="_blank">Gabarito</a></li><ul>';
                            }
                        }

                        echo '</div>'; 
                        echo '</div>'; 
                    } else {
                        echo '<p>Não há provas cadastradas.</p>';
                    }
                } catch (Exception $erro) {
                    echo "ATENÇÃO, erro na consulta: " .  $erro->getMessage();
                }
                ?>
            </div>
        </div>
    <?php require 'footer.php'; ?>
  </body>

  </html>
<?php else:
  echo "<script>alert('Você precisa fazer Login para continuar!');</script>";
  header('Refresh:0; url=login.php');
endif; ?>