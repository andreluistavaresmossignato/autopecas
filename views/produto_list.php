<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Peças - Auto Peças do Baiano</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 1400px; margin: 0 auto; background: white; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.3); padding: 40px; }
        .header { text-align: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 3px solid #ff6b35; }
        .header h1 { color: #1e3c72; font-size: 2.5em; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 2px; }
        .header .subtitle { color: #666; font-size: 1.1em; }
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 12px 30px; background: #ff6b35; color: white; border: none; border-radius: 5px; font-size: 1em; font-weight: 600; cursor: pointer; text-decoration: none; text-align: center; transition: all 0.3s; text-transform: uppercase; letter-spacing: 1px; margin: 5px; }
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
        .btn-outline { background: transparent; border: 2px solid #ff6b35; color: #ff6b35; }
        .btn-outline:hover { background: #ff6b35; color: white; }
        
        /* 🔽 CABEÇALHO DO FILTRO (Botão clicável) */
        .filter-header {
            display: flex; align-items: center; gap: 10px;
            background: #1e3c72; color: white;
            padding: 12px 20px; border-radius: 8px 8px 0 0;
            font-weight: 600; cursor: pointer; width: fit-content;
            user-select: none; transition: background 0.3s;
        }
        .filter-header:hover { background: #2a5298; }
        .filter-arrow { transition: transform 0.3s ease; font-size: 1.1em; }
        
        /* 📦 PAINEL DO FILTRO (Colapsável) */
        .filter-panel {
            background: #f8f9fa; border-radius: 0 0 8px 8px;
            border: 1px solid #dee2e6; border-top: none;
            max-height: 0; overflow: hidden; opacity: 0;
            transition: max-height 0.4s ease, opacity 0.3s ease;
        }
        .filter-panel.open { max-height: 800px; opacity: 1; }
        .filter-content { padding: 20px; }
        
        .filter-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px; }
        .filter-group { display: flex; flex-direction: column; gap: 5px; }
        .filter-group label { font-size: 0.85em; color: #555; font-weight: 500; }
        .filter-group input { padding: 10px 12px; border: 2px solid #ddd; border-radius: 5px; font-size: 0.95em; transition: border-color 0.3s; }
        .filter-group input:focus { outline: none; border-color: #ff6b35; }
        .filter-actions { display: flex; gap: 10px; margin-top: 15px; flex-wrap: wrap; }
        .search-box { grid-column: 1 / -1; }
        .search-box input { width: 100%; padding: 12px 15px; border: 2px solid #ff6b35; border-radius: 5px; font-size: 1em; }
        
        /* 📊 Tabela */
        .table-container { overflow-x: auto; margin-top: 20px; }
        .table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .table thead { background: #1e3c72; color: white; }
        .table th { padding: 15px; text-align: left; font-weight: 600; text-transform: uppercase; font-size: 0.9em; letter-spacing: 0.5px; }
        .table td { padding: 12px 15px; border-bottom: 1px solid #ddd; vertical-align: middle; }
        .table tbody tr:hover { background: #f8f9fa; }
        .table tbody tr:nth-child(even) { background: #f8f9fa; }
        .actions { display: flex; gap: 8px; flex-wrap: wrap; }
        .footer { text-align: center; margin-top: 40px; padding-top: 20px; border-top: 1px solid #ddd; color: #666; font-size: 0.9em; }
        .text-center { text-align: center; }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 0.8em; font-weight: 600; }
        .badge-low { background: #ffe5e5; color: #dc3545; }
        .badge-ok { background: #e5f7e5; color: #28a745; }
        .empty-state { text-align: center; padding: 50px 20px; color: #666; }
        .empty-state .icon { font-size: 3em; margin-bottom: 15px; opacity: 0.5; }
        
        @media (max-width: 768px) {
            .container { padding: 20px; }
            .header h1 { font-size: 1.8em; }
            .table { font-size: 0.85em; }
            .table th, .table td { padding: 8px; }
            .actions { flex-direction: column; }
            .btn { width: 100%; margin: 2px 0; justify-content: center; }
            .filter-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="bi bi-car-front-fill"></i> Peças em Estoque</h1>
            <p class="subtitle">Auto Peças do Baiano</p>
        </div>
        
        <div class="text-center" style="margin-bottom: 20px;">
            <a href="../controllers/ProdutoController.php?acao=dashboard" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Voltar ao Dashboard</a>
            <a href="../controllers/ProdutoController.php?acao=novo" class="btn btn-success"><i class="bi bi-plus-lg"></i> Nova Peça</a>
        </div>
        
        <!-- 🔽 Botão de Toggle -->
        <div class="filter-header" onclick="toggleFilter()">
            <i class="bi bi-chevron-down filter-arrow" id="filterArrow"></i> Filtrar Produtos 
        </div>
        
        <!-- 📦 Painel Colapsável -->
        <form method="GET" action="../controllers/ProdutoController.php" class="filter-panel" id="filterPanel">
            <div class="filter-content">
                <input type="hidden" name="acao" value="listar">
                <div class="filter-grid">
                    <div class="search-box filter-group">
                        <label for="nome"><i class="bi bi-search"></i> Buscar por nome da peça</label>
                        <input type="text" id="nome" name="nome" placeholder="Digite o nome..." value="<?= htmlspecialchars($_GET['nome'] ?? '') ?>">
                    </div>
                    <div class="filter-group">
                        <label for="codigo">Código</label>
                        <input type="text" id="codigo" name="codigo" placeholder="Ex: FIL-001" value="<?= htmlspecialchars($_GET['codigo'] ?? '') ?>">
                    </div>
                    <div class="filter-group">
                        <label for="estoque_min">Estoque Mín.</label>
                        <input type="number" id="estoque_min" name="estoque_min" min="0" placeholder="0" value="<?= htmlspecialchars($_GET['estoque_min'] ?? '') ?>">
                    </div>
                    <div class="filter-group">
                        <label for="estoque_max">Estoque Máx.</label>
                        <input type="number" id="estoque_max" name="estoque_max" min="0" placeholder="999" value="<?= htmlspecialchars($_GET['estoque_max'] ?? '') ?>">
                    </div>
                    <div class="filter-group">
                        <label for="preco_min">Preço Mín. (R$)</label>
                        <input type="number" id="preco_min" name="preco_min" step="0.01" min="0" placeholder="0,00" value="<?= htmlspecialchars($_GET['preco_min'] ?? '') ?>">
                    </div>
                    <div class="filter-group">
                        <label for="preco_max">Preço Máx. (R$)</label>
                        <input type="number" id="preco_max" name="preco_max" step="0.01" min="0" placeholder="9999,99" value="<?= htmlspecialchars($_GET['preco_max'] ?? '') ?>">
                    </div>
                </div>
                <div class="filter-actions">
                    <button type="submit" class="btn"><i class="bi bi-funnel"></i> Filtrar</button>
                    <a href="../controllers/ProdutoController.php?acao=listar" class="btn btn-outline"><i class="bi bi-x-circle"></i> Limpar Filtros</a>
                </div>
            </div>
        </form>
        
        <!-- 📊 Tabela -->
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
                            <td><?= htmlspecialchars(substr($p['descricao'], 0, 40)) ?><?= strlen($p['descricao']) > 40 ? '...' : '' ?></td>
                            <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
                            <td>
                                <span class="badge <?= $p['quantidade_estoque'] < 5 ? 'badge-low' : 'badge-ok' ?>">
                                    <?= $p['quantidade_estoque'] ?> un
                                </span>
                            </td>
                            <td class="actions">
                                <a href="../controllers/ProdutoController.php?acao=editar&id=<?= $p['id'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Editar</a>
                                <a href="../controllers/ProdutoController.php?acao=excluir&id=<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('⚠️ Tem certeza que deseja excluir esta peça?');"><i class="bi bi-trash"></i> Excluir</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7">
                            <div class="empty-state">
                                <div class="icon"><i class="bi bi-box-seam"></i></div>
                                <p><strong>Nenhuma peça encontrada</strong> com os filtros selecionados.</p>
                                <p style="font-size: 0.9em; margin-top: 10px;">Tente ajustar os filtros ou <a href="../controllers/ProdutoController.php?acao=novo">cadastrar uma nova peça</a>.</p>
                            </div>
                        </td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="footer">
            <p>Total de peças exibidas: <strong><?= count($produtos) ?></strong></p>
            
            <!-- 📊 Botão para Estatísticas -->
            <a href="../controllers/ProdutoController.php?acao=estatisticas" class="btn" style="margin-top: 15px; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                <i class="bi bi-graph-up-arrow"></i> Ver Estatísticas do Estoque
            </a>
        </div>
    </div>

    <script>
        function toggleFilter() {
            const panel = document.getElementById('filterPanel');
            const arrow = document.getElementById('filterArrow');
            panel.classList.toggle('open');
            arrow.style.transform = panel.classList.contains('open') ? 'rotate(180deg)' : 'rotate(0deg)';
        }
    </script>
</body>
</html>