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
      <main class="cadastro-main">
        <div class="container">
            <div class="form-image">
                <img src="imgs/studying2.svg">
            </div>
            <div class="form">
                <form>
                    <div class="form-header">
                        <div class="title">
                           <h1>Cadastre-se</h1> 
                        </div>
                        <div class="cadastro-login-button">
                        <a href="login.php"><button type="button">Entrar</button></a>
                        </div>  
                    </div>

                    <div class="cadastro-input-group">
                        <div class="cadastro-input-box">
                            <label for="firstname">Primeiro Nome</label>
                            <input type="text" name="firstname" id="firstname" placeholder="Digite seu Primeiro Nome" required>
                        </div>
                        <div class="cadastro-input-box">
                            <label for="lastname">Sobrenome</label>
                            <input type="text" name="lastname" id="lastname" placeholder="Digite seu Sobrenome" required>
                        </div>
                        <div class="cadastro-input-box">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" placeholder="Digite seu E-mail" required>
                        </div>
                        <div class="cadastro-input-box">
                            <label for="number">Celular</label>
                            <input type="tel" name="number" id="number" placeholder="(xx) xxxxx xxxx" required maxlength="11">
                        </div>
                        <div class="cadastro-input-box">
                            <label for="password">Senha</label>
                            <input type="password" name="password" id="password" placeholder="Digite sua Senha" required maxlength="20">
                        </div>
                        <div class="cadastro-input-box">
                            <label for="Confirmpassword">Confirme sua senha</label>
                            <input type="password" name="Confirmpassword" id="Confirmpassword" placeholder="Confirme sua Senha" required maxlength="20">
                        </div>
                    </div>
                    <div class="gender-inputs">
                        <div class="gender-title">
                            <h6>Gênero</h6>
                        </div>
                        <div class="gender-group" required>
                            <div class="gender-input">
                                <input type="radio" value="M" name="gender" id="male">
                                <label for="male">Masculino</label>
                            </div>
                            <div class="gender-input">
                                <input type="radio" value="F" name="gender" id="female">
                                <label for="female">Feminino</label>
                            </div>
                            <div class="gender-input">
                                <input type="radio" value="O" name="gender" id="others">
                                <label for="others">Outros</label>
                            </div>
                            <div class="gender-input">
                                <input type="radio" value="N" name="gender" id="none">
                                <label for="none">Prefiro não dizer</label>
                            </div>
                        </div>
                    </div>

                    <div class="continue-button">
                        <button type="button" onclick="cadastro()">Continuar</button>
                    </div>
                </form>
            </div>
        </div>
      </main>
      <?php require 'footer.php'; ?>
</body>
</html>

