<?php
session_start();

$base_path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

if (isset($_SESSION['usuario_logado'])) {
    header("Location:$base_path/controllers/ProdutoController.php?acao=dashboard");
    exit;
}

header("Location:$base_path/views/login.php");
exit;
?>