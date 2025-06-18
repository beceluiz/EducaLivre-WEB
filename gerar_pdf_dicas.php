<?php
require('conexao.php');
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if (!isset($_SESSION['idUsuario']) || empty($_SESSION['idUsuario'])) {
    echo "<script>alert('Você precisa fazer Login para continuar!');</script>";
    header('Refresh: 1; url=login.php');
    exit;
}

$pdo = conectar();

try {
    $sql = $pdo->prepare("SELECT idDica, Usuario.nome, tituloDica, 
                         textoDica, FORMAT(dataDica, 'dd/MM/yyyy') as dataDica
                         FROM Dica
                         INNER JOIN Usuario ON usuario.idUsuario = dica.idUsuario 
                         ORDER BY idDica DESC");
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $options->set('isRemoteEnabled', true);
    
    $dompdf = new Dompdf($options);
    
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
                line-height: 1.6;
            }
            .header {
                text-align: center;
                margin-bottom: 30px;
                border-bottom: 2px solid #333;
                padding-bottom: 10px;
            }
            .dica-container {
                margin-bottom: 25px;
                border: 1px solid #ddd;
                padding: 15px;
                border-radius: 8px;
                background-color: #f9f9f9;
            }
            .titulo-dica {
                font-size: 18px;
                font-weight: bold;
                color: #333;
                margin-bottom: 10px;
            }
            .texto-dica {
                margin: 15px 0;
                text-align: justify;
                color: #555;
            }
            .autor-info {
                margin-top: 15px;
                padding-top: 10px;
                border-top: 1px solid #eee;
                font-size: 12px;
                color: #666;
            }
            .autor-info p {
                margin: 2px 0;
            }
            .total-dicas {
                text-align: center;
                margin-top: 20px;
                font-style: italic;
                color: #777;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <h1>Relatório de Dicas</h1>
            <p>Gerado em: ' . date('d/m/Y H:i:s') . '</p>
        </div>
    ';
    
    if (count($resultado) > 0) {
        foreach ($resultado as $dica) {
            $html .= '
            <div class="dica-container">
                <div class="titulo-dica">' . htmlspecialchars($dica["tituloDica"]) . '</div>
                <div class="texto-dica">' . nl2br(htmlspecialchars($dica["textoDica"])) . '</div>
                <div class="autor-info">
                    <p><strong>Autor:</strong> ' . htmlspecialchars($dica["nome"]) . '</p>
                    <p><strong>Data:</strong> ' . $dica["dataDica"] . '</p>
                </div>
            </div>';
        }
        
        $html .= '<div class="total-dicas">Total de dicas: ' . count($resultado) . '</div>';
    } else {
        $html .= '<p style="text-align: center; color: #999;">Nenhuma dica encontrada.</p>';
    }
    
    $html .= '
    </body>
    </html>';
    
    $dompdf->loadHtml($html);
    
    $dompdf->setPaper('A4', 'portrait');
    
    $dompdf->render();
    
    $nomeArquivo = "dicas_" . date('Y-m-d_H-i-s') . ".pdf";
    
    $dompdf->stream($nomeArquivo, array("Attachment" => false)); // false = abre no navegador, true = força download
    
} catch (Exception $erro) {
    echo "Erro ao gerar PDF: " . $erro->getMessage();
}
?>