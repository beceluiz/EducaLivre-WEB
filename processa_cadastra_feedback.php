<?php
require 'conexao.php';

$pdo = conectar();
$tabela = "feedback";

date_default_timezone_set('America/Sao_Paulo');

if(isset($_POST['nota']) && !empty($_POST['nota']) && isset($_POST['texto-feedback']) && !empty($_POST['texto-feedback']) && isset($_SESSION['idUsuario']) && !empty($_SESSION['idUsuario'])) {
    $textoFeedbackNoTags = strip_tags($_POST["texto-feedback"]);

    $textoFeedback = htmlspecialchars($textoFeedbackNoTags, ENT_QUOTES, 'UTF-8');
    $notaFeedback = $_POST["nota"];

    $dataFeedback = date('d-m-Y');
    $idUsuario = $_SESSION['idUsuario'];

    if ($notaFeedback < 1 || $notaFeedback > 5 || strlen($textoFeedback) < 5) {
    echo "<script>alert('Nota deve ser de 1 a 5 e o texto deve ter pelo menos 5 caracteres.'); window.location.href='cadastra_feedback.php';</script>";
    exit;
}


    try {
    $sql = $pdo->prepare("INSERT INTO $tabela (notaFeedback, textoFeedback, dataFeedback, idUsuario)
                          VALUES (:nota, :texto, :dataFeedback, :idUsuario)");

    $sql->bindValue(":nota", $notaFeedback);
    $sql->bindValue(":texto",  $textoFeedback);
    $sql->bindValue(":dataFeedback",  $dataFeedback);
    $sql->bindValue(":idUsuario",  $idUsuario);
    $sql->execute();

    header("Location: feedbacks.php?cadastrado=1");
    
    } catch (PDOException $e) {
        error_log("Erro ao cadastrar dica: " . $e->getMessage());
        echo "<script>alert('Erro ao cadastrar dica. Tente novamente.'); window.location.href='cadastra_dica.php';</script>";
        exit;
    }
} else {
    header("Location: cadastra_feedback.php");
}
?>