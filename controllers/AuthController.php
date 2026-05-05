<?php
session_start();
require_once '../models/Usuario.php';

$acao = $_GET['acao'] ?? '';

if ($acao == 'login') {
    $usuario_form = $_POST['usuario'];
    $senha_form = $_POST['senha'];
    $usuarioModel = new Usuario();
    $user_id = $usuarioModel->autenticar($usuario_form, $senha_form);

    if ($user_id) {
        $_SESSION['usuario_logado'] = $user_id;
        header("Location:../controllers/ProdutoController.php?acao=dashboard");
        exit;
    } else {
        echo '
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Acesso Negado - Auto Peças do Baiano</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <style>
                * { margin: 0; padding: 0; box-sizing: border-box; }
                body {
                    font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;
                    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
                    min-height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 20px;
                }
                .error-card {
                    background: white;
                    padding: 40px;
                    border-radius: 10px;
                    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
                    max-width: 450px;
                    width: 100%;
                    text-align: center;
                    animation: slideDown 0.3s ease;
                }
                @keyframes slideDown {
                    from { opacity: 0; transform: translateY(-20px); }
                    to { opacity: 1; transform: translateY(0); }
                }
                .error-icon {
                    font-size: 4em;
                    color: #dc3545;
                    margin-bottom: 20px;
                }
                .error-title {
                    color: #1e3c72;
                    font-size: 1.5em;
                    margin-bottom: 10px;
                    font-weight: 700;
                }
                .error-message {
                    color: #666;
                    margin-bottom: 25px;
                    line-height: 1.5;
                }
                .btn-back {
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                    padding: 12px 30px;
                    background: #ff6b35;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                    font-weight: 600;
                    transition: all 0.3s;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    font-size: 0.9em;
                }
                .btn-back:hover {
                    background: #e55a2b;
                    transform: translateY(-2px);
                    box-shadow: 0 5px 15px rgba(255,107,53,0.4);
                }
                .footer {
                    margin-top: 30px;
                    padding-top: 20px;
                    border-top: 1px solid #eee;
                    color: #999;
                    font-size: 0.85em;
                }
                @media (max-width: 480px) {
                    .error-card { padding: 30px 20px; }
                    .error-icon { font-size: 3em; }
                }
            </style>
        </head>
        <body>
            <div class="error-card">
                <div class="error-icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
                <h2 class="error-title">Acesso Negado</h2>
                <p class="error-message">Login ou senha inválidos.<br>Verifique suas credenciais e tente novamente.</p>
                <a href="../views/login.php" class="btn-back">
                    <i class="bi bi-arrow-left"></i> Voltar para o Login
                </a>
                <div class="footer">
                    <p>&copy; <?= date(\'Y\') ?> Auto Peças do Baiano</p>
                </div>
            </div>
        </body>
        </html>
        ';
    }
} elseif ($acao == 'logout') {
    session_destroy();
    header("Location:../views/login.php"); 
    exit;
}
?>