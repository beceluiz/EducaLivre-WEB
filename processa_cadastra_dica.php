<?php
require 'conexao.php';

$pdo = conectar();
$tabela = "dica";

date_default_timezone_set('America/Sao_Paulo');

if(isset($_POST['titulo-dica']) && !empty($_POST['titulo-dica']) && isset($_POST['texto-dica']) && !empty($_POST['texto-dica']) ) {
    $tituloDicaNoTags = strip_tags( $_POST["titulo-dica"]) ;
    $textoDicaNoTags = strip_tags($_POST["texto-dica"]);


    $tituloDica = htmlspecialchars($tituloDicaNoTags, ENT_QUOTES, 'UTF-8');
    $textoDica = htmlspecialchars($textoDicaNoTags, ENT_QUOTES, 'UTF-8');
    $idUsuario = $_SESSION['idUsuario'];
    $dataDica = date('d-m-Y');
    

    try {
        $sql = $pdo->prepare("INSERT INTO $tabela (tituloDica, textoDica, dataDica, idUsuario) 
                              VALUES (:titulo, :texto, :dataDica, :idUsuario)");

        $sql->bindValue(":titulo", $tituloDica);
        $sql->bindValue(":texto", $textoDica);
        $sql->bindValue(":dataDica", $dataDica);
        $sql->bindValue(":idUsuario", $idUsuario);
        $sql->execute();

        header("Location: dicas.php?cadastrada=1");
        exit;
    } catch (PDOException $e) {
        error_log("Erro ao cadastrar dica: " . $e->getMessage());
        echo "<script>alert('Erro ao cadastrar dica. Tente novamente.'); window.location.href='cadastra_dica.php';</script>";
        exit;
    }
} else {
    header("Location: cadastra_dica.php");
    exit;
}
?>