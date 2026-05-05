<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Auto Peças do Baiano</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; background: white; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.3); padding: 40px; }
        .header { text-align: center; margin-bottom: 40px; padding-bottom: 20px; border-bottom: 3px solid #ff6b35; }
        .header h1 { color: #1e3c72; font-size: 2.5em; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 2px; }
        .header .subtitle { color: #666; font-size: 1.1em; }
        .dashboard-menu { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 30px; }
        .menu-card { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; border-radius: 10px; text-align: center; text-decoration: none; color: white; transition: all 0.3s; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        .menu-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.3); }
        .menu-card .icon { font-size: 3em; margin-bottom: 15px; }
        .menu-card h3 { font-size: 1.3em; margin-bottom: 10px; }
        .menu-card p { font-size: 0.9em; opacity: 0.9; }
        .menu-card.listar { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .menu-card.cadastrar { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .menu-card.sair { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); grid-column: 1 / -1; }
        .footer { text-align: center; margin-top: 40px; padding-top: 20px; border-top: 1px solid #ddd; color: #666; font-size: 0.9em; }
        .text-center { text-align: center; }
        @media (max-width: 768px) {
            .container { padding: 20px; }
            .header h1 { font-size: 1.8em; }
            .dashboard-menu { grid-template-columns: 1fr; }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔧 Auto Peças do Baiano</h1>
            <p class="subtitle">Sistema de Gestão de Estoque</p>
        </div>
        
        <h2 class="text-center" style="margin-bottom: 20px;">Painel de Controle</h2>
        
        <div class="dashboard-menu">
            <a href="../controllers/ProdutoController.php?acao=listar" class="menu-card listar">
                <div class="icon"><i class="bi bi-car-front-fill"></i></div>
                <h3>Listar Produtos</h3>
                <p>Visualize todo o estoque de peças disponíveis</p>
            </a>
            
            <a href="../controllers/ProdutoController.php?acao=novo" class="menu-card cadastrar">
                <div class="icon"><i class="bi bi-plus-lg"></i></div>
                <h3>Cadastrar Novo Produto</h3>
                <p>Adicione novas peças ao catálogo</p>
            </a>
            
            <a href="../controllers/AuthController.php?acao=logout" class="menu-card sair">
                <div class="icon"><i class="bi bi-person-walking"></i></div>
                <h3>Sair do Sistema</h3>
                <p>Encerre sua sessão com segurança</p>
            </a>
        </div>
        
        <div class="footer">
            <p>&copy; <?= date('Y') ?> Auto Peças do Baiano - Todos os direitos reservados</p>
            <p>Sistema desenvolvido pelos alunos do 3º AMS-DS</p>
        </div>
    </div>
</body>
</html>