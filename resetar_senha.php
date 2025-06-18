<?php
require 'conexao.php';
$pdo = conectar();
date_default_timezone_set('America/Sao_Paulo');

$token = $_GET['token'] ?? '';
if (!$token) {
    header("location: index.php");
}

// Verifica token
$stmt = $pdo->prepare("
    SELECT email, expires_at
    FROM password_resets
    WHERE token = :token
");
$stmt->execute([':token' => $token]);
$reset = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reset || strtotime($reset['expires_at']) < time()) {
 header('Location: esqueci_minha_senha.php?expired=1');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novaSenha = $_POST['senha'] ?? '';
    $confSenha = $_POST['conf_senha'] ?? '';
    if (empty($novaSenha) || $novaSenha !== $confSenha) {
        $erro = 'Senhas não conferem ou estão vazias.';
    } else {
        $hash = password_hash($novaSenha, PASSWORD_DEFAULT);
        $upd = $pdo->prepare("UPDATE Usuario SET senha = :hash WHERE email = :email");
        $upd->execute([
            ':hash'  => $hash,
            ':email' => $reset['email']
        ]);

        $del = $pdo->prepare("DELETE FROM password_resets WHERE token = :token");
        $del->execute([':token' => $token]);

        header('Location: login.php?senha_atualizada=1');
        exit;
    }
}
?>

<!-- Formulário HTML -->
<!-- <!doctype html>
<html>
<head><meta charset="utf-8"><title>Redefinir senha</title></head>
<body>
  <?php if (!empty($erro)): ?>
    <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
  <?php endif; ?>
  <form method="POST">
    <label>Nova senha:<br>
      <input type="password" name="senha" required>
    </label><br><br>
    <label>Confirmar nova senha:<br>
      <input type="password" name="conf_senha" required>
    </label><br><br>
    <button type="submit">Redefinir senha</button>
  </form>
</body>
</html> -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar Senha</title>
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
  <script src="jquery-3.7.1.js"></script>
  <script src="script.js"></script>
</head>
<body>
  <?php require 'header.php'; ?>
  <main>
    <div class="cadastra-dica-main reset-senha-main">
      <div class="cadastra-dica-container reset-senha-container">
      <?php if (!empty($erro)): ?>
    <p style="color:red; margin: 0 auto; padding-top: 10px;"><?= htmlspecialchars($erro) ?></p>
  <?php endif; ?>
        <form class="cadastra-dica-form reset-senha-form" method="post">
        <label class="reset-senha-input">Nova senha:<br>
      <input type="password" name="senha"   required>
    </label><br><br>
    <label class="reset-senha-input">Confirmar nova senha:<br>
      <input type="password" name="conf_senha"  required>
    </label><br><br>
          <div class="cadastra-dica-button-group reset-senha-button">
            <button type="submit" class="cadastra-dica-button">Alterar senha</button>
          </div>
        </form>
      </div>
    </div>
  </main>
  <?php require 'footer.php'; ?>
</body>
</html>