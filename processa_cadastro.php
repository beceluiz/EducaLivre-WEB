<?php
require 'conexao.php';

$pdo = conectar();
$tabela = "usuario";
date_default_timezone_set('America/Sao_Paulo');

header("Content-Type: application/json");
if($_POST) {


try {
    // Sanitização básica
    $nome = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_SPECIAL_CHARS);
    $sobrenome = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $celular = filter_input(INPUT_POST, "number", FILTER_SANITIZE_NUMBER_INT);
    $genero = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_SPECIAL_CHARS);
    $senha = $_POST["password"];
    $dataCriacao = date('d-m-Y');

    if (!$nome || !$sobrenome || !$email || !$celular || !$genero || !$senha) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Dados inválidos ou incompletos."]);
        exit;
    }

    $sql = $pdo->prepare("SELECT COUNT(*) FROM $tabela WHERE email = :email");
    $sql->bindValue(":email", $email);
    $sql->execute();

    if ($sql->fetchColumn() > 0) {
        echo json_encode(["status" => "error", "message" => "E-mail já cadastrado!"]);
        exit;
    }

    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

    $sql = $pdo->prepare("INSERT INTO $tabela (nome, sobrenome, email, celular, genero, senha, dataCriacao) 
                          VALUES (:nome, :sobrenome, :email, :celular, :genero, :senha, :dataCriacao)");

    $sql->bindValue(":nome", $nome);
    $sql->bindValue(":sobrenome", $sobrenome);
    $sql->bindValue(":email", $email);
    $sql->bindValue(":celular", $celular);
    $sql->bindValue(":genero", $genero);
    $sql->bindValue(":senha", $senhaCriptografada);
    $sql->bindValue(":dataCriacao", $dataCriacao);

    $sql->execute();

    echo json_encode(["status" => "success", "message" => "Cadastrado com sucesso!"]);

} catch (Exception $erro) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Erro interno: " . $erro->getMessage()]);
}
} else {
    header("Location: cadastro.php");
    echo json_encode(["status" => "error", "message" => "Metodo nao permitido."]);
    exit;
}
