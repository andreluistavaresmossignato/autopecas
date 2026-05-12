<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estatísticas - Auto Peças do Baiano</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 1400px; margin: 0 auto; background: white; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.3); padding: 40px; }
        .header { text-align: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 3px solid #ff6b35; }
        .header h1 { color: #1e3c72; font-size: 2.5em; margin-bottom: 10px; display: flex; align-items: center; justify-content: center; gap: 12px; }
        .header .subtitle { color: #666; font-size: 1.1em; }
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 12px 30px; background: #ff6b35; color: white; border: none; border-radius: 5px; font-size: 1em; font-weight: 600; cursor: pointer; text-decoration: none; text-align: center; transition: all 0.3s; text-transform: uppercase; letter-spacing: 1px; margin: 5px; }
        .btn:hover { background: #e55a2b; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(255,107,53,0.4); }
        .btn-secondary { background: #6c757d; }
        .btn-secondary:hover { background: #5a6268; }
        .text-center { text-align: center; }
        
        /* Cards de Estatísticas */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .stat-card { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 25px; border-radius: 10px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        .stat-card.warning { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .stat-card.success { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .stat-card.info { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: #1e3c72; }
        .stat-value { font-size: 2em; font-weight: 700; margin: 10px 0; }
        .stat-label { font-size: 0.9em; opacity: 0.95; }
        
        /* Gráfico */
        .chart-container { background: #f8f9fa; border-radius: 10px; padding: 25px; margin-bottom: 40px; border: 1px solid #dee2e6; }
        .chart-title { font-size: 1.3em; color: #1e3c72; margin-bottom: 20px; font-weight: 600; display: flex; align-items: center; gap: 8px; }
        .chart-wrapper { position: relative; height: 400px; }
        
        /* Lista de Reposição */
        .reposicao-container { background: #fff5f5; border: 2px solid #fed7d7; border-radius: 10px; padding: 25px; }
        .reposicao-title { color: #c53030; font-size: 1.3em; margin-bottom: 20px; font-weight: 600; display: flex; align-items: center; gap: 8px; }
        .reposicao-list { list-style: none; }
        .reposicao-item { display: flex; justify-content: space-between; align-items: center; padding: 12px 15px; background: white; border-radius: 8px; margin-bottom: 10px; border-left: 4px solid #fc8181; }
        .reposicao-item .info { flex: 1; }
        .reposicao-item .nome { font-weight: 600; color: #1e3c72; }
        .reposicao-item .codigo { font-size: 0.85em; color: #666; }
        .reposicao-item .estoque { background: #fed7d7; color: #c53030; padding: 5px 12px; border-radius: 20px; font-weight: 600; font-size: 0.9em; }
        .reposicao-item .btn-sm { padding: 6px 15px; font-size: 0.85em; }
        
        .empty-state { text-align: center; padding: 30px; color: #666; }
        .empty-state .icon { font-size: 3em; margin-bottom: 15px; opacity: 0.5; }
        
        @media (max-width: 768px) {
            .container { padding: 20px; }
            .header h1 { font-size: 1.8em; flex-wrap: wrap; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .chart-wrapper { height: 300px; }
            .reposicao-item { flex-direction: column; gap: 10px; text-align: center; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="bi bi-graph-up-arrow"></i> Estatísticas do Estoque</h1>
            <p class="subtitle">Auto Peças do Baiano</p>
        </div>
        
        <div class="text-center" style="margin-bottom: 30px;">
            <a href="../controllers/ProdutoController.php?acao=dashboard" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar ao Dashboard
            </a>
        </div>
        
        <!-- 📊 Cards de Estatísticas -->
        <div class="stats-grid">
            <div class="stat-card info">
                <i class="bi bi-box-seam" style="font-size: 2em;"></i>
                <div class="stat-value"><?= $estatisticas['total_produtos'] ?></div>
                <div class="stat-label">Total de Peças</div>
            </div>
            <div class="stat-card success">
                <i class="bi bi-currency-dollar" style="font-size: 2em;"></i>
                <div class="stat-value">R$ <?= number_format($estatisticas['valor_estoque'], 2, ',', '.') ?></div>
                <div class="stat-label">Valor em Estoque</div>
            </div>
            <div class="stat-card">
                <i class="bi bi-calculator" style="font-size: 2em;"></i>
                <div class="stat-value">R$ <?= number_format($estatisticas['preco_medio'], 2, ',', '.') ?></div>
                <div class="stat-label">Preço Médio</div>
            </div>
            <div class="stat-card warning">
                <i class="bi bi-exclamation-triangle" style="font-size: 2em;"></i>
                <div class="stat-value"><?= $estatisticas['baixo_estoque'] ?></div>
                <div class="stat-label">Precisam de Reposição</div>
            </div>
        </div>
        
        <!-- 📈 Gráfico de Produtos -->
        <div class="chart-container">
            <div class="chart-title"><i class="bi bi-bar-chart-line"></i> Preço vs Estoque por Peça</div>
            <div class="chart-wrapper">
                <canvas id="produtosChart"></canvas>
            </div>
        </div>
        
        <!-- ⚠️ Lista de Reposição -->
        <div class="reposicao-container">
            <div class="reposicao-title"><i class="bi bi-cart-x"></i> Peças que Precisam de Reposição</div>
            
            <?php if(count($reposicao) > 0): ?>
                <ul class="reposicao-list">
                    <?php foreach($reposicao as $p): ?>
                    <li class="reposicao-item">
                        <div class="info">
                            <div class="nome"><?= htmlspecialchars($p['nome']) ?></div>
                            <div class="codigo">Cód: <?= htmlspecialchars($p['codigo_peca']) ?></div>
                        </div>
                        <span class="estoque"><?= $p['quantidade_estoque'] ?> un</span>
                        <a href="../controllers/ProdutoController.php?acao=editar&id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Ajustar
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <div class="empty-state">
                    <div class="icon"><i class="bi bi-check-circle"></i></div>
                    <p><strong>Tudo em ordem!</strong> Nenhuma peça precisa de reposição no momento.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // 📊 Configuração do Gráfico com Chart.js
        const ctx = document.getElementById('produtosChart').getContext('2d');
        
        // Dados vindos do PHP
        const labels = <?= json_encode(array_column($dadosGrafico, 'nome')) ?>;
        const precos = <?= json_encode(array_column($dadosGrafico, 'preco')) ?>;
        const estoques = <?= json_encode(array_column($dadosGrafico, 'quantidade_estoque')) ?>;
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Preço (R$)',
                        data: precos,
                        backgroundColor: 'rgba(30, 60, 114, 0.7)',
                        borderColor: '#1e3c72',
                        borderWidth: 2,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Estoque (un)',
                        data: estoques,
                        backgroundColor: 'rgba(255, 107, 53, 0.7)',
                        borderColor: '#ff6b35',
                        borderWidth: 2,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: { display: true, text: 'Preço (R$)' },
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        title: { display: true, text: 'Quantidade' },
                        grid: { drawOnChartArea: false }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { maxRotation: 45, minRotation: 45 }
                    }
                },
                plugins: {
                    legend: { position: 'top' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + 
                                    (context.datasetIndex === 0 ? 'R$ ' : '') + 
                                    context.parsed.y.toLocaleString('pt-BR');
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>