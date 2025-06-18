<?php

require('conexao.php');

if (isset($_SESSION['idUsuario'])) {
    
    unset($_SESSION['idUsuario']);
    session_destroy(); 

    header("Location: login.php?logout=1");
    exit(); 
} else {
    header("Location: login.php");
    exit();
}


?>