<?php
require('conexao.php');

if(isset($_SESSION['idUsuario']) && !empty($_SESSION['idUsuario'])):
    header("Location: index.php");
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <script src="jquery-3.7.1.js"></script>
    <script src="script.js"></script>
</head>
<body>
    <?php require 'header.php'; ?>
      <?php
if (isset($_GET['logout']) && $_GET['logout'] == 1 && !isset($_SESSION['idUsuario'])) {
    echo "<script>alert('Você saiu com sucesso!');</script>";
}
if (isset($_GET['recuperado']) && $_GET['recuperado'] == 1) {
    echo "<script>alert('Sua senha foi enviada para o email cadastrado!');</script>";
  }
  if (isset($_GET['senha_atualizada']) && $_GET['senha_atualizada'] == 1) {
    echo "<script>alert('Sua senha alterada com sucesso!');</script>";
  }
?>
      <main class="cadastro-main">
        <div class="container">
            <div class="form-image">
                <img src="imgs/studying2.svg">
            </div>
            <div class="form">
                <form action="processa_login.php" method="post">
                    <div class="form-header">
                        <div class="title">
                           <h1>Entrar</h1> 
                        </div>
                        <div class="login-login-button">
                        <a href="cadastro.php"><button type="button">Cadastre-se</button></a>
                        </div>  
                    </div>

                    <div class="login-input-group">
                        <div class="login-input-box">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" placeholder="Digite seu E-mail" required>
                        </div>
                        <div class="login-input-box">
                            <label for="password">Senha</label>
                            <input type="password" name="password" id="password" placeholder="Digite sua Senha" required>
                        </div>
                        <div class="continue-button" id="btn-esqueci-minha-senha">
                        <a href="esqueci_minha_senha.php">Esqueci Minha Senha</a>
                    </div>
                    </div>
                    
                    <div class="continue-button" >
                        <button type="submit">Continuar</button>
                    </div>
                </form>
            </div>
        </div>
      </main>
      <?php require 'footer.php'; ?>
</body>
</html>