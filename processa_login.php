<?php
require 'conexao.php';

$tabela = "usuario";

function login($email, $senha) {
    try {
        $pdo = conectar();
        $tabela = "usuario";

        $sql = $pdo->prepare("SELECT * FROM $tabela WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();

        $resultado = $sql->fetch();

        if ($resultado && password_verify($senha, $resultado['senha'])) {
            $_SESSION['idUsuario'] = $resultado['idUsuario'];
            $_SESSION['isAdmin'] = $resultado['isAdmin'];
            $_SESSION['nome'] = $resultado['nome'];
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        error_log("Erro de login: " . $e->getMessage());
        return false;  // Retorna false se houver erro
    }

}

if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) ) {

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['password'];

    if(login($email,$senha) == true) {
         if(isset($_SESSION['idUsuario'])) {
        header("Location: index.php?login=1");
         } else {
        header("Location: login.php");
         }
    } else {
        echo "<script>alert('Usuario ou senha incorretos!');</script>";
        header('Refresh: 1; url=login.php'); 
    }
} else {
    header("Location: login.php");
}


?>