<?php
require('conexao.php');

if (isset($_SESSION['idUsuario']) && !empty($_SESSION['idUsuario'])):
  ?>
  <!DOCTYPE html>
  <html lang="pt-br">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matérias</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet">
    <script src="jquery-3.7.1.js"></script>
    <script src="script.js"></script>
  </head>

  <body>
    <?php require 'header.php'; ?>
    <main>
      <div class="materias-main">
        <?php
        $pdo = conectar();
      try {
          $queryAreas = $pdo->prepare(query: "SELECT idAreaEstudo, nomeAreaEstudo FROM AreaEstudo ORDER BY idAreaEstudo");
          $queryAreas->execute();
          $areasEstudo = $queryAreas->fetchAll(PDO::FETCH_ASSOC);
          foreach($areasEstudo as $area) {
            echo '<div class="container-accordion">
            <p class="area-de-estudo">' . $area['nomeAreaEstudo'] . '</p> ';
            
            $queryMaterias = $pdo->prepare("
            SELECT DISTINCT 
                Materia.idMateria,
                Materia.nomeMateria
            FROM 
                Materia
            WHERE 
                Materia.idAreaEstudo = :idAreaEstudo
            ORDER BY 
                Materia.idMateria
           ");
            $queryMaterias->bindParam(':idAreaEstudo', $area["idAreaEstudo"], PDO::PARAM_INT);
            $queryMaterias->execute();
            
            $materias = $queryMaterias->fetchAll(PDO::FETCH_ASSOC);
            foreach($materias as $materia) {
              echo '<div class="accordion">
                    <button class="accordion-header" onclick="openAccordion(this)">
                        <Span>' . $materia['nomeMateria'] . '</Span>
                        <img src="imgs/chevron-down.svg" alt="" class="chevron">
                    </button>
                    <div class="accordion-body">
                        <ul class="accordion-materias-list">';
            
            $queryTopicos = $pdo->prepare(" 
                    SELECT 
                    nomeTopico, 
                    linkTopico,
                    idMateria
                    FROM 
                    Topico
                    WHERE 
                    idMateria = :idMateria
                    ORDER BY 
                    idTopico");
            $queryTopicos->bindParam(':idMateria', $materia["idMateria"], PDO::PARAM_INT);
            $queryTopicos->execute();
            
            $topicos = $queryTopicos->fetchAll(PDO::FETCH_ASSOC);
            foreach($topicos as $topico) {
              if(empty($topico["linkTopico"]) || !isset($topico["linkTopico"])) {
                echo '<li class="temas-anteriores">'. $topico["nomeTopico"]. '</li>';
               } else {

                echo '<li><a href="' . $topico['linkTopico'] . 
                '" target="_blank">' .  $topico['nomeTopico'] . '</a></li>';
               }

            }
            echo    '</ul>
                  </div>
              </div>';

            }
            
            echo '</div>';
          }
        } catch (Exception $erro) {
          echo "ATENÇÃO, erro na consulta: " .
            $erro->getmessage();
          ;
        }
        ?>
        <!-- <div class="container-accordion">
          <p class="area-de-estudo">Ciências Humanas e suas Tecnologias</p>
          <div class="accordion">
            <button class="accordion-header" onclick="openAccordion(this)">
              <Span>História</Span>
              <img src="imgs/chevron-down.svg" alt="" class="chevron">
            </button>

            <div class="accordion-body">
              <ul class="accordion-materias-list">
                <li><a href="https://www.youtube.com/watch?v=KlUWB_k0Kf4&list=PLPNLvl90MqKQFcZIk1H7_yv0pwcc9ynx0" target="_blank">Idade Contemporânea</a></li>
                <li><a href="https://www.youtube.com/watch?v=4hEDjSdszSU" target="_blank">2ª Guerra Mundial e suas consequências</a></li>
                <li><a href="https://www.youtube.com/watch?v=sP2kl0irjBQ&list=PLPNLvl90MqKStxdRIwxQeu3LPzFPsMfap" target="_blank">Brasil Colônia</a></li>
                <li><a href="https://www.youtube.com/watch?v=TzwFrYCd-6M" target="_blank">Primeiro Reinado</a></li>
                <li><a href="https://www.youtube.com/watch?v=7zs6-atp_ik" target="_blank">Segundo Reinado</a></li>
                <li><a href="https://www.youtube.com/watch?v=4ceFMDndn_0" target="_blank">Governos pós-regime militar - Redemocratização</a></li>
                <li><a href="https://www.youtube.com/watch?v=jQU6Ojetq8M" target="_blank">Era Vargas</a></li>
                <li><a href="https://www.youtube.com/watch?v=cuHddXfinDE" target="_blank">História Política </a></li>
                <li><a href="https://www.youtube.com/watch?v=8PAMZzDvN1A" target="_blank">República Velha</a></li>
                <li><a href="https://www.youtube.com/watch?v=RJX-wTMONWM" target="_blank">Patrimônio Histórico-Cultural e Memória</a></li>
              </ul>
            </div>
          </div>
          <div class="accordion">
            <button class="accordion-header" onclick="openAccordion(this)">
              <Span>Geografia</Span>
              <img src="imgs/chevron-down.svg" alt="" class="chevron">
            </button>
            <div class="accordion-body">
              <ul class="accordion-materias-list">
                <li><a href="https://www.youtube.com/watch?v=RzeYTW1Y3Kk&list=PLH0kQ6bXLZnU-vg8iDRymngVRqIFylQ3l" target="_blank">Geografia Agrária</a></li>
                <li><a href="https://www.youtube.com/watch?v=kyPD3yze4DQ" target="_blank">Questões Ambientais</a></li>
                <li><a href="https://www.youtube.com/watch?v=tkn-YU7rleQ" target="_blank">Geografia Física</a></li>
                <li><a href="https://www.youtube.com/watch?v=jPZyKuMrAj4" target="_blank">Geografia Urbana</a></li>
                <li><a href="https://www.youtube.com/watch?v=Ekxzj16mA8A&list=PL2Znz6U0vJHUfcU2xt9G1ClRZl0DCB8Yw" target="_blank">Climatologia</a></li>
                <li><a href="https://www.youtube.com/watch?v=gwXKwVwfQmU" target="_blank">Urbanização</a></li>
                <li><a href="https://www.youtube.com/watch?v=WG_1PC9Ht9M" target="_blank">Globalização</a></li>
                <li><a href="https://www.youtube.com/watch?v=5bObBFWg0t0&list=PL2Znz6U0vJHVRmWoGfM4_EwBr4XtBpIn-" target="_blank">Cartografia</a></li>
                <li><a href="https://www.youtube.com/watch?v=kayp5ikmdRc" target="_blank">Indústria</a></li>
              </ul>
            </div>
          </div>
          <div class="accordion">
            <button class="accordion-header" onclick="openAccordion(this)">
              <Span>Filosofia</Span>
              <img src="imgs/chevron-down.svg" alt="" class="chevron">
            </button>

            <div class="accordion-body">
              <ul class="accordion-materias-list">
                <li><a href="https://www.youtube.com/watch?v=9-bvJy6CvOY" target="_blank">Aristóteles e escola helenística</a></li>
                <li><a href="https://www.youtube.com/watch?v=92OBGFJg0lM" target="_blank">Ética e Justiça</a></li>
                <li><a href="https://www.youtube.com/watch?v=IUSCQr9OtqM" target="_blank">Racionalismo moderno</a></li>
                <li><a href="https://www.youtube.com/watch?v=Zy7EwpV3qqI" target="_blank">Filosofia Antiga</a></li>
                <li><a href="https://www.youtube.com/watch?v=HJ0G0FNDrb4" target="_blank">Escola sofística, Sócrates e Platão</a></li>
                <li><a href="https://www.youtube.com/watch?v=6COggNzoqME&list=PLRuYby0fu5YLxYUwQG3RP3BT8QzWsC8SP" target="_blank">Filosofia Contemporânea</a></li>
                <li><a href="https://www.youtube.com/watch?v=5SMC3YJSqu0" target="_blank">Natureza do Conhecimento</a></li>
                <li><a href="https://www.youtube.com/watch?v=IOPir9GymRA&list=PLH0kQ6bXLZnXGUfZir7i7Z-R4nSHVk-3m" target="_blank">Filosofia Moderna</a></li>
                <li><a href="https://www.youtube.com/watch?v=2cRmI_bYEyc" target="_blank">Escola de Frankfurt</a></li>
              </ul>
            </div>
          </div>
          <div class="accordion">
            <button class="accordion-header" onclick="openAccordion(this)">
              <Span>Sociologia</Span>
              <img src="imgs/chevron-down.svg" alt="" class="chevron">
            </button>

            <div class="accordion-body">
              <ul class="accordion-materias-list">
                <li><a href="https://www.youtube.com/watch?v=hh19mqzQJaU" target="_blank">Sociologia contemporânea</a></li>
                <li><a href="https://www.youtube.com/watch?v=HUO3MquFdjk" target="_blank">Mundo do Trabalho</a></li>
                <li><a href="https://www.youtube.com/watch?v=QCKuVoJlHZU" target="_blank">Cultura e Indústria Cultural</a></li>
                <li><a href="https://www.youtube.com/watch?v=85V6shQPPL8" target="_blank">Ideologia</a></li>
                <li><a href="https://www.youtube.com/watch?v=0M82Owal1Us" target="_blank">Meios de Comunicação, Tecnologia e Cultura de Massa</a></li>
                <li><a href="https://www.youtube.com/watch?v=yztZtoo7yRg" target="_blank">Cidadania</a></li>
                <li><a href="https://www.youtube.com/watch?v=hjyfDZMZHUo" target="_blank">Capitalismo</a></li>
                <li><a href="https://www.youtube.com/watch?v=LQPffshbEvE" target="_blank">Economia e sociedade</a></li>
              </ul>
            </div>
          </div>


        </div>
        <div class="container-accordion">
          <p class="area-de-estudo">Linguagens, Códigos e suas Tecnologias</p>
          <div class="accordion">
            <button class="accordion-header" onclick="openAccordion(this)">
              <Span>Língua Portuguesa e Literatura</Span>
              <img src="imgs/chevron-down.svg" alt="" class="chevron">
            </button>

            <div class="accordion-body">
              <ul class="accordion-materias-list">
                <li><a href="https://www.youtube.com/watch?v=XIXUpBBBQLE&list=PLEjz9losBoODKff5MqWwMQtibltWjJ31N" target="_blank">Interpretação de textos</a></li>
                <li><a href="https://www.youtube.com/watch?v=zo4ABcSAO_0" target="_blank">Tendências contemporâneas</a></li>
                <li><a href="https://www.youtube.com/watch?v=FcymE4kwvgQ" target="_blank">Estrutura e formação das palavras</a></li>
                <li><a href="https://www.youtube.com/watch?v=51Vj6uzsdaA" target="_blank">Tipos de texto</a></li>
                <li><a href="https://www.youtube.com/watch?v=ViYtv5dOLUY" target="_blank">Elementos da narrativa: análise da pessoa, do espaço e do tempo</a></li>
                <li><a href="https://www.youtube.com/watch?v=d6kS7zj8p2Q" target="_blank">Funções da linguagem</a></li>
                <li><a href="https://www.youtube.com/watch?v=ODkVN0kRciE" target="_blank">Pontuação</a></li>
                <li><a href="https://www.youtube.com/watch?v=hxjT67hHy4A" target="_blank">Narratividade</a></li>
                <li><a href="https://www.youtube.com/watch?v=xXyfKXW-Y0M" target="_blank">Literatura</a></li>
                <li><a href="https://www.youtube.com/watch?v=iepzxa5QBt0" target="_blank">Classe de palavras</a></li>
                <li><a href="https://www.youtube.com/watch?v=TUX8TNThh0c" target="_blank">Verbo</a></li>
              </ul>
            </div>
          </div>
          <div class="accordion">
            <button class="accordion-header" onclick="openAccordion(this)">
              <Span>Inglês</Span>
              <img src="imgs/chevron-down.svg" alt="" class="chevron">
            </button>

            <div class="accordion-body">
              <ul class="accordion-materias-list">
                <li><a href="https://www.youtube.com/watch?v=jBkRAG8L12o" target="_blank">Interpretação de Textos</a></li>
                <li><a href="https://www.youtube.com/watch?v=kFAZMHepv9I" target="_blank">Domínio Lexical</a></li>
                <li><a href="https://www.youtube.com/watch?v=WOR5hbFIoSI" target="_blank">Identificação de Função do Texto</a></li>
              </ul>
            </div>
          </div>
          <div class="accordion">
            <button class="accordion-header" onclick="openAccordion(this)">
              <Span>Espanhol</Span>
              <img src="imgs/chevron-down.svg" alt="" class="chevron">
            </button>

            <div class="accordion-body">
              <ul class="accordion-materias-list">
                <li><a href="https://www.youtube.com/watch?v=4hSLNq18IdY" target="_blank">Interpretação de Textos</a></li>
                <li><a href="https://www.youtube.com/watch?v=ajllxqY24zU" target="_blank">Domínio Lexical</a></li>
                <li><a href="https://www.youtube.com/watch?v=TeG208iwuuc" target="_blank">Identificação de Função do Texto </a></li>
              </ul>
            </div>
          </div>
          <div class="accordion">
            <button class="accordion-header" onclick="openAccordion(this)">
              <Span>Artes</Span>
              <img src="imgs/chevron-down.svg" alt="" class="chevron">
            </button>

            <div class="accordion-body">
              <ul class="accordion-materias-list">
                <li><a href="https://www.youtube.com/watch?v=vQoJ7eG992Y" target="_blank">Arte Contemporânea</a></li>
                <li><a href="https://www.youtube.com/watch?v=fxqxH5A3Ok8&t=42s" target="_blank">Arte nos séculos XV e XVI </a></li>
                <li><a href="https://www.youtube.com/watch?v=8S_8vYCqrNE" target="_blank">Elementos básicos das Artes Plásticas</a></li>
                <li><a href="https://www.youtube.com/watch?v=PVybw8JWUsM" target="_blank">Elementos básicos de Música</a></li>
                <li><a href="https://www.youtube.com/watch?v=vgVjt1uUSao" target="_blank">Música no século XX</a></li>
              </ul>
            </div>
          </div>
          <div class="accordion">
            <button class="accordion-header" onclick="openAccordion(this)">
              <Span>Educação Física</Span>
              <img src="imgs/chevron-down.svg" alt="" class="chevron">
            </button>

            <div class="accordion-body">
              <ul class="accordion-materias-list">
                <li><a href="https://www.youtube.com/watch?v=C0XtsQ89gHA" target="_blank">Esporte e espetáculo</a></li>
                <li><a href="https://www.youtube.com/watch?v=F8X3_4cHKWgz" target="_blank">Influência da mídia no corpo</a></li>
              </ul>
            </div>
          </div>

        </div>

        <div class="container-accordion">
          <p class="area-de-estudo">Ciências da Natureza e suas Tecnologias</p>
          <div class="accordion">
            <button class="accordion-header" onclick="openAccordion(this)">
              <Span>Química</Span>
              <img src="imgs/chevron-down.svg" alt="" class="chevron">
            </button>

            <div class="accordion-body">
              <ul class="accordion-materias-list">
                <li><a href="https://www.youtube.com/watch?v=btRNcrRYBas" target="_blank">Físico-Química</a></li>
                <li><a href="https://www.youtube.com/watch?v=S5O-_kHn3W0" target="_blank">Química Geral</a></li>
                <li><a href="https://www.youtube.com/watch?v=SGTXk-2uSys" target="_blank">Química Orgânica</a></li>
                <li><a href="https://www.youtube.com/watch?v=6CK3WbBLt_k" target="_blank">Ligações químicas, polaridade e forças</a></li>
                <li><a href="https://www.youtube.com/watch?v=OwAVDeLnCig" target="_blank">Reações orgânicas</a></li>
                <li><a href="https://www.youtube.com/watch?v=AmTCrsqD0P4" target="_blank">Compostos orgânicos</a></li>
                <li><a href="https://www.youtube.com/watch?v=0Yl42XmgOkk" target="_blank">Eletroquímica</a></li>
                <li><a href="https://www.youtube.com/watch?v=m3mUEb6ULf8" target="_blank">Soluções</a></li>
                <li><a href="https://www.youtube.com/watch?v=HVKA6xLhBsY" target="_blank">Energia</a></li>
              </ul>
            </div>
          </div>
          <div class="accordion">
            <button class="accordion-header" onclick="openAccordion(this)">
              <Span>Física</Span>
              <img src="imgs/chevron-down.svg" alt="" class="chevron">
            </button>

            <div class="accordion-body">
              <ul class="accordion-materias-list">
                <li><a href="https://www.youtube.com/watch?v=E3q4yTpPy3M" target="_blank">Mecânica</a></li>
                <li><a href="https://www.youtube.com/watch?v=HVKA6xLhBsY" target="_blank">Eletricidade e Energia</a></li>
                <li><a href="https://www.youtube.com/watch?v=0siWJcMRM-A" target="_blank">Ondulatória</a></li>
                <li><a href="https://www.youtube.com/watch?v=nLn5BxL4Cn4&list=PLbBLq1So0quXo0r4Kt-d--1WrdtXiN0gx" target="_blank">Termologia</a></li>
                <li><a href="https://www.youtube.com/watch?v=Nlxs8r4xvpk" target="_blank">Acústica</a></li>
                <li><a href="https://www.youtube.com/watch?v=Ml_NyaV6oNk&list=PL2QMqoE75Xroa0UHXCQs1hG6Vij63j4NJ" target="_blank">Energia, Trabalho e Potência</a></li>
                <li><a href="https://www.youtube.com/watch?v=1GjTKvyzIdA" target="_blank">Resistores</a></li>
                <li><a href="https://www.youtube.com/watch?v=axZtbpC-wFk" target="_blank">Calorimetria</a></li>
                <li><a href="https://www.youtube.com/watch?v=SReHoDOMYW0" target="_blank">Impulso, Quantidade de Movimento e Análise Dimensional</a></li>
                <li><a href="https://www.youtube.com/watch?v=UMn7hAfpU6o" target="_blank">Introdução à Óptica Geométrica</a></li>
              </ul>
            </div>
          </div>
          <div class="accordion">
            <button class="accordion-header" onclick="openAccordion(this)">
              <Span>Biologia</Span>
              <img src="imgs/chevron-down.svg" alt="" class="chevron">
            </button>

            <div class="accordion-body">
              <ul class="accordion-materias-list">
                <li><a href="https://www.youtube.com/watch?v=utxzvj61WmI&list=PL6jnBBqoDNyIQnCByEQq6kPDW-7JaUmoc" target="_blank">Humanidade e Ambiente</a></li>
                <li><a href="https://www.youtube.com/watch?v=N33jWXzV8RU&list=PLSCwcUriz1RJznmlFfSVlHvPCp8Cg2r9X" target="_blank">Citologia</a></li>
                <li><a href="https://www.youtube.com/watch?v=emucgjvtdw0&list=PLj4yVuRqCKGFCWTdCgeImy9ZA23KNC4eJ" target="_blank">Histologia e Fisiologia</a></li>
                <li><a href="https://www.youtube.com/watch?v=pJnPe3M013w" target="_blank">Sistema Imunológico</a></li>
                <li><a href="https://www.youtube.com/watch?v=8W_U7WOS0_0" target="_blank">Ecossistemas</a></li>
                <li><a href="https://www.youtube.com/watch?v=Z5cll6n3hHw" target="_blank">Fundamentos da Ecologia</a></li>
                <li><a href="https://www.youtube.com/watch?v=RDmb9OXtS4w" target="_blank">Biotecnologia</a></li>
                <li><a href="https://www.youtube.com/watch?v=LFqaBPFXAh0" target="_blank">DNA e RNA</a></li>
                <li><a href="https://www.youtube.com/watch?v=FZK4MJbafTU" target="_blank">Genética</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="container-accordion">
          <p class="area-de-estudo">Matemática e suas Tecnologias</p>
          <div class="accordion">
            <button class="accordion-header" onclick="openAccordion(this)">
              <Span>Matemática</Span>
              <img src="imgs/chevron-down.svg" alt="" class="chevron">
            </button>

            <div class="accordion-body">
              <ul class="accordion-materias-list">
                <li><a href="https://www.youtube.com/watch?v=M_gUL7yxl_A&list=PLQVUQftDIJQEEsEuc9ieGsNmUdi9uI5Xr" target="_blank">Geometria</a></li>
                <li><a href="https://www.youtube.com/watch?v=NhwrayP3DjY" target="_blank">Equação do Primeiro Grau</a></li>
                <li><a href="https://www.youtube.com/watch?v=Sa7BjeyitV0" target="_blank">Equação do Segundo Grau</a></li>
                <li><a href="https://www.youtube.com/watch?v=QiEnHOk0jys" target="_blank">Escalas, Razão e Proporção</a></li>
                <li><a href="https://www.youtube.com/watch?v=s0acSwFvsm4" target="_blank">Grandezas proporcionais e médias algébricas</a></li>
                <li><a href="https://www.youtube.com/watch?v=ByihuRMs-uc" target="_blank">Aritmética</a></li>
                <li><a href="https://www.youtube.com/watch?v=UByudQUOZrw" target="_blank">Porcentagem e Matemática Financeira</a></li>
                <li><a href="https://www.youtube.com/watch?v=XzZGAwfKs_k" target="_blank">Gráficos e Tabelas</a></li>
                <li><a href="https://www.youtube.com/watch?v=hgKTmAO-k7E" target="_blank">Funções</a></li>
                <li><a href="https://www.youtube.com/watch?v=KEbbZULcnOQ" target="_blank">Noções Básicas de Estatística</a></li>
                <li><a href="https://www.youtube.com/watch?v=yCAhR3T_r5g" target="_blank">Probabilidade</a></li>
                <li><a href="https://www.youtube.com/watch?v=th5k6bzSDTA" target="_blank">Área de Figuras Planas e Área dos Polígonos</a></li>
              </ul>
            </div>
          </div>

        </div>
        <div class="container-accordion">
          <p class="area-de-estudo">Redação</p>
          <div class="accordion">
            <button class="accordion-header" onclick="openAccordion(this)">
              <Span>Temas Anteriores</Span>
              <img src="imgs/chevron-down.svg" alt="" class="chevron">
            </button>

            <div class="accordion-body">
              <ul class="accordion-materias-list">
                  <li class="temas-anteriores">2024 - Desafios para a valorização da herança africana no Brasil</li>
                  <li class="temas-anteriores">2023 - Desafios para o enfrentamento da invisibilidade do trabalho de cuidado realizado pela mulher no Brasil</li>
                  <li class="temas-anteriores">2022 - Desafios para a valorização de comunidades e povos tradicionais no Brasil</li>
                  <li class="temas-anteriores">2021 - Invisibilidade e registro civil: garantia de acesso à cidadania no Brasil</li>
                  <li class="temas-anteriores">2020 - O estigma associado às doenças mentais na sociedade brasileira</li>
                  <li class="temas-anteriores">2020 - O desafio de reduzir as desigualdades entre as regiões do Brasil</li>
                  <li class="temas-anteriores">2019 - Democratização do acesso ao cinema no Brasil</li>
                  <li class="temas-anteriores">2018 - Manipulação do comportamento do usuário pelo controle de dados na Internet</li>
                  <li class="temas-anteriores">2017 - Desafios para a formação educacional de surdos no Brasil</li>
                  <li class="temas-anteriores">2016 - Caminhos para combater a intolerância religiosa no Brasil</li>
                  <li class="temas-anteriores">2015 - A persistência da violência contra a mulher na sociedade brasileira</li>
                  <li class="temas-anteriores">2014 - Publicidade infantil em questão no Brasil</li>
              </ul>
            </div>
            
          </div>
          <div class="accordion">
            <button class="accordion-header" onclick="openAccordion(this)">
              <Span>Curso de redação para Enem</Span>
              <img src="imgs/chevron-down.svg" alt="" class="chevron">
            </button>

            <div class="accordion-body">
              <ul class="accordion-materias-list">
                <li><a href="https://www.youtube.com/watch?v=7bP1auwDPJM&list=PLQVUQftDIJQFv71TmR-j-wfMOYsB-f6tk" target="_blank">CURSO REDAÇÃO ENEM: COMEÇANDO DO ZERO</a></li>
              </ul>
            </div>
        </div> -->

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