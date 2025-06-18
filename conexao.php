<?php
function conectar() {
    $local_server = "DESKTOP-77FVJ8D";
    $usuario_server = "sa";
    $senha_server = "123";
    $banco_de_dados = "educaLivre";

    try {
        $pdo = new PDO("sqlsrv:server=$local_server;database=$banco_de_dados", $usuario_server, $senha_server);
        return $pdo;
    } catch (Exception $erro) {
        echo json_encode([
            "status" => "error",
            "message" => "Erro na conexão: " . $erro->getMessage()
        ]);
        die;
    }
}

session_start();

?>
