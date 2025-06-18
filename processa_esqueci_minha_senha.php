<?php
require 'conexao.php';
require_once('PHPMailer/PHPMailer.php');
require_once('PHPMailer/SMTP.php');
require_once('PHPMailer/Exception.php');
require_once('config_email_example.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$pdo = conectar();

try {
    $sql = $pdo->prepare("EXEC sp_LimparTokensExpirados");
    $sql->execute();
} catch (Exception $e) {
    error_log("Erro na limpeza de tokens: " . $e->getMessage());
}

date_default_timezone_set('America/Sao_Paulo');


if (empty($_POST['email-recuperacao'])) {
    header('Location: esqueci_minha_senha.php?error=empty');
    exit;
}

$email = $_POST['email-recuperacao'];
$sql = $pdo->prepare("SELECT idUsuario FROM Usuario WHERE email = :email");
$sql->bindValue(':email', $email);
$sql->execute();

if (!$sql->rowCount()) {
    header('Location: esqueci_minha_senha.php?notfound=1');
    exit;
}
 
$token = bin2hex(random_bytes(16));
$expires = date('d-m-Y H:i:s', strtotime('+1 hour'));
$created = date('d-m-Y H:i:s');

$ins = $pdo->prepare("
    INSERT INTO password_resets (email, token, created_at, expires_at)
    VALUES (:email, :token, :created_at, :expires_at)
");
$ins->execute([
    ':email'      => $email,
    ':token'      => $token,
    ':created_at' => $created,
    ':expires_at' => $expires,
]);

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->SMTPAuth   = true;
    $mail->Username   = EMAIL_USERNAME;
    $mail->Password   = EMAIL_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('no-reply@seusite.com', 'EducaLivre');
    $mail->addAddress($email);

    $link = "localhost/TCC/resetar_senha.php?token={$token}";
    $mail->isHTML(true);
    $mail->Subject = 'Recuperação de senha EducaLivre';
    $mail->Body = "
<!DOCTYPE html>
<html lang='pt-BR'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Recuperação de Senha</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
            color: #000000;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            border-radius: 5px;
            padding: 30px;
            border: 1px solid #e0e0e0;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
        }
        .logo {
            margin-bottom: 15px;
        }
        h1 {
            color: #000000;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 15px;
            font-size: 16px;
        }
        .btn {
            display: inline-block;
            background-color: #00BF63;
            color: white !important;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 4px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
        }
        .btn:hover {
            background-color: #009e52;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #000000;
            text-align: center;
        }
        .note {
            font-size: 13px;
            color: #555555;
            font-style: italic;
        }
        .divider {
            height: 3px;
            background-color: #00BF63;
            margin: 15px 0;
            width: 100%;
        }
        .plain-link {
            word-break: break-all;
            font-size: 13px;
            text-align: center;
            margin-top: 5px;
            color: #555555;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <div class='divider'></div>
            <h1>Recuperação de Senha</h1>
        </div>
        
        <p>Olá,</p>
        
        <p>Recebemos uma solicitação para redefinir a senha da sua conta. Para continuar com este processo, clique no botão abaixo:</p>
        
        <div style='text-align: center;'>
            <a href='{$link}' class='btn'>Redefinir Minha Senha</a>
            <p class='plain-link'>Se o botão não funcionar, copie e cole o link abaixo no seu navegador:<br>{$link}</p>
        </div>
        
        <p>Este link é válido por apenas <strong>1 hora</strong>. Após este período, você precisará solicitar uma nova redefinição de senha.</p>
        
        <p class='note'>Se você não solicitou esta alteração, por favor ignore este e-mail ou entre em contato com nossa equipe de suporte caso tenha dúvidas.</p>
        
        <div class='divider'></div>
        
        <div class='footer'>
            <p>&copy; " . date('Y') . " EducaLivre | Todos os direitos reservados</p>
        </div>
    </div>
</body>
</html>
";

$mail->AltBody = "
Recuperação de Senha

Você pediu para redefinir sua senha. 
Para continuar, acesse o link abaixo (válido por 1 hora):
{$link}

Se você não solicitou esta alteração, por favor ignore este e-mail.
";

    $mail->send();
    header('Location: esqueci_minha_senha.php?sent=1');
    exit;

} catch (Exception $e) {
  error_log(
      sprintf(
          "[%s] Erro ao enviar e‑mail de recuperação para %s: %s\n",
          date('Y-m-d H:i:s'),
          $email,
          $mail->ErrorInfo
      ),
      0
  );

  header('Location: index.php?error=email_fail');
  exit;
}