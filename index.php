<?php
require('conexao.php');
require('default_users.php');
if (isset($_GET['login']) && $_GET['login'] == 1 && isset($_SESSION['idUsuario'])) {
  echo "<script>alert('Login realizado com sucesso!');</script>";
}
// unset($_SESSION['admins_criados']);
criaAdms();
if (isset($_GET['error']) && $_GET['error'] == 'email_fail' ){
    echo "<script>alert('Não foi possivel recuperar sua senha, tente novamente!');</script>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <script src="jquery-3.7.1.js"></script>
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css" />
    <script src="script.js"></script>
  </head>
  <body>
  <?php require 'header.php'; ?>
<main class="home-main">
    <div class="home-container">
      <div class="first-section">
        <h1>Bem-vindo ao EducaLivre!</h1>
        <p>O <strong>EducaLivre</strong> é mais que uma plataforma de estudos; é o seu aliado na preparação para o vestibular. Aqui, você encontra resumos completos, playlists organizadas, simulados e dicas valiosas, tudo criado para facilitar o seu aprendizado. Nossa missão é oferecer um espaço acessível e direto, onde o estudo se torna mais eficiente e motivador.</p>
      </div>
      <div class="second-section">
        <img class="notebook-image" src="imgs/notebook.svg" alt="">
      </div>
        
    </div>

    <div class="home-container">
      <div class="third-section">
        <img class="notebook-image" src="imgs/notebook2.svg" alt="">
      </div>
      <div class="fourth-section">
        <h2>Explore nossas funcionalidades:</h2>
        <ul class="home-funcionalidades">
          <li><strong>Matérias e Resumos</strong>: Encontre conteúdos divididos por tópicos e revise os pontos essenciais.</li>
          <li><strong>Simulados Realistas</strong>: Treine com questões no estilo dos vestibulares, avalie seu progresso e aprimore suas habilidades.</li>
          <li><strong>Dicas e Estratégias</strong>: Aprenda com dicas exclusivas para organizar seus estudos e mandar bem nas provas.</li>
        </ul>
        
        <p>No <strong>EducaLivre</strong>, você está um passo mais perto do seu objetivo. Aproveite tudo o que preparamos para sua jornada!</p>
      </div>
    </div>
</main>
<?php require 'footer.php'; ?>
</body>
</html>