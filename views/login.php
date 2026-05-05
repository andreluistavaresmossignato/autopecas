<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Auto Peças do Baiano</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="icon">🔧</div>
            <h2>Auto Peças do Baiano</h2>
            <p>Sistema de Gestão</p>
        </div>
        
        <form action="../controllers/AuthController.php?acao=login" method="POST">
            <div class="form-group">
                <label for="usuario"><i class="bi bi-person-fill"></i> Usuário</label>
                <input type="text" id="usuario" name="usuario" required placeholder="Digite seu usuário" autofocus>
            </div>
            
            <div class="form-group">
                <label for="senha"><i class="bi bi-key-fill"></i> Senha</label>
                <input type="password" id="senha" name="senha" required placeholder="Digite sua senha">
            </div>
            
            <button type="submit" class="btn btn-primary">Entrar no Sistema</button>
        </form>
        
        <div class="footer">
            <p>&copy; <?= date('Y') ?> Auto Peças do Baiano</p>
        </div>
    </div>
</body>
</html>