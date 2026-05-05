<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Peças - Auto Peças do Baiano</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; background: white; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.3); padding: 40px; }
        .header { text-align: center; margin-bottom: 40px; padding-bottom: 20px; border-bottom: 3px solid #ff6b35; }
        .header h1 { color: #1e3c72; font-size: 2.5em; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 2px; }
        .header .subtitle { color: #666; font-size: 1.1em; }
        .btn { display: inline-block; padding: 12px 30px; background: #ff6b35; color: white; border: none; border-radius: 5px; font-size: 1em; font-weight: 600; cursor: pointer; text-decoration: none; text-align: center; transition: all 0.3s; text-transform: uppercase; letter-spacing: 1px; margin: 5px; }
        .btn:hover { background: #e55a2b; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(255,107,53,0.4); }
        .btn-secondary { background: #6c757d; }
        .btn-secondary:hover { background: #5a6268; }
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        .btn-warning { background: #ffc107; color: #333; }
        .btn-warning:hover { background: #e0a800; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        .btn-sm { padding: 6px 12px; font-size: 0.85em; }
        .table-container { overflow-x: auto; margin-top: 30px; }
        .table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .table thead { background: #1e3c72; color: white; }
        .table th { padding: 15px; text-align: left; font-weight: 600; text-transform: uppercase; font-size: 0.9em; letter-spacing: 0.5px; }
        .table td { padding: 12px 15px; border-bottom: 1px solid #ddd; }
        .table tbody tr:hover { background: #f8f9fa; }
        .table tbody tr:nth-child(even) { background: #f8f9fa; }
        .actions { display: flex; gap: 8px; flex-wrap: wrap; }
        .footer { text-align: center; margin-top: 40px; padding-top: 20px; border-top: 1px solid #ddd; color: #666; font-size: 0.9em; }
        .text-center { text-align: center; }
        @media (max-width: 768px) {
            .container { padding: 20px; }
            .header h1 { font-size: 1.8em; }
            .table { font-size: 0.85em; }
            .table th, .table td { padding: 8px; }
            .actions { flex-direction: column; }
            .btn { width: 100%; margin: 2px 0; }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📦 Peças em Estoque</h1>
            <p class="subtitle">Auto Peças do Baiano</p>
        </div>
        
        <div class="text-center" style="margin-bottom: 20px;">
            <a href="../controllers/ProdutoController.php?acao=dashboard" class="btn btn-secondary">⬅ Voltar ao Dashboard</a>
            <a href="../controllers/ProdutoController.php?acao=novo" class="btn btn-success"><i class="bi bi-plus-lg"></i> Nova Peça</a>
        </div>
        
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th><th>Código</th><th>Nome</th><th>Descrição</th><th>Preço</th><th>Estoque</th><th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($produtos) > 0): ?>
                        <?php foreach($produtos as $p): ?>
                        <tr>
                            <td><?= $p['id'] ?></td>
                            <td><strong><?= htmlspecialchars($p['codigo_peca']) ?></strong></td>
                            <td><?= htmlspecialchars($p['nome']) ?></td>
                            <td><?= htmlspecialchars(substr($p['descricao'], 0, 50)) ?>...</td>
                            <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
                            <td style="color: <?= $p['quantidade_estoque'] < 5 ? '#dc3545' : '#28a745' ?>; font-weight: bold;">
                                <?= $p['quantidade_estoque'] ?> un
                            </td>
                            <td class="actions">
                                <a href="../controllers/ProdutoController.php?acao=editar&id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                                <a href="../controllers/ProdutoController.php?acao=excluir&id=<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('⚠️ Tem certeza que deseja excluir esta peça?');">🗑️ Excluir</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center" style="padding: 40px; color: #666;">📭 Nenhuma peça cadastrada no estoque</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="footer">
            <p>Total de peças cadastradas: <strong><?= count($produtos) ?></strong></p>
        </div>
    </div>
</body>
</html>