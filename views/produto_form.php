<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($produto) ? 'Editar' : 'Cadastrar' ?> Peça - Auto Peças do Baiano</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; background: white; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.3); padding: 40px; }
        .header { text-align: center; margin-bottom: 40px; padding-bottom: 20px; border-bottom: 3px solid #ff6b35; }
        .header h1 { color: #1e3c72; font-size: 2.5em; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 2px; }
        .header .subtitle { color: #666; font-size: 1.1em; }
        .form-container { max-width: 800px; margin: 0 auto; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #333; font-weight: 600; }
        .form-group input, .form-group textarea { width: 100%; padding: 12px 15px; border: 2px solid #ddd; border-radius: 5px; font-size: 1em; transition: all 0.3s; }
        .form-group input:focus, .form-group textarea:focus { outline: none; border-color: #ff6b35; box-shadow: 0 0 5px rgba(255,107,53,0.3); }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-actions { display: flex; gap: 15px; margin-top: 30px; justify-content: center; flex-wrap: wrap; }
        .btn { display: inline-block; padding: 12px 30px; background: #ff6b35; color: white; border: none; border-radius: 5px; font-size: 1em; font-weight: 600; cursor: pointer; text-decoration: none; text-align: center; transition: all 0.3s; text-transform: uppercase; letter-spacing: 1px; }
        .btn:hover { background: #e55a2b; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(255,107,53,0.4); }
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        .btn-secondary { background: #6c757d; }
        .btn-secondary:hover { background: #5a6268; }
        .footer { text-align: center; margin-top: 40px; padding-top: 20px; border-top: 1px solid #ddd; color: #666; font-size: 0.9em; }
        @media (max-width: 768px) {
            .container { padding: 20px; }
            .header h1 { font-size: 1.8em; }
            .form-row { grid-template-columns: 1fr; }
            .form-actions { flex-direction: column; }
            .btn { width: 100%; }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔧 <?= isset($produto) ? 'Editar Peça' : 'Nova Peça' ?></h1>
            <p class="subtitle">Auto Peças do Baiano</p>
        </div>
        
        <div class="form-container">
            <form action="../controllers/ProdutoController.php?acao=salvar" method="POST">
                <input type="hidden" name="id" value="<?= $produto['id'] ?? '' ?>">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="codigo_peca">🔢 Código da Peça *</label>
                        <input type="text" id="codigo_peca" name="codigo_peca" value="<?= htmlspecialchars($produto['codigo_peca'] ?? '') ?>" required placeholder="Ex: FIL-001">
                    </div>
                    <div class="form-group">
                        <label for="nome">📝 Nome da Peça *</label>
                        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($produto['nome'] ?? '') ?>" required placeholder="Ex: Filtro de Óleo">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="descricao">📄 Descrição</label>
                    <textarea id="descricao" name="descricao" rows="4" placeholder="Descreva a peça, compatibilidade, marca, etc..."><?= htmlspecialchars($produto['descricao'] ?? '') ?></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="preco">💰 Preço (R$) *</label>
                        <input type="number" id="preco" name="preco" step="0.01" min="0" value="<?= $produto['preco'] ?? '' ?>" required placeholder="0,00">
                    </div>
                    <div class="form-group">
                        <label for="quantidade_estoque">📊 Quantidade em Estoque *</label>
                        <input type="number" id="quantidade_estoque" name="quantidade_estoque" min="0" value="<?= $produto['quantidade_estoque'] ?? '' ?>" required placeholder="0">
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">💾 Salvar Dados</button>
                    <a href="../controllers/ProdutoController.php?acao=listar" class="btn btn-secondary">❌ Cancelar</a>
                </div>
            </form>
        </div>
        
        <div class="footer">
            <p>* Campos obrigatórios</p>
        </div>
    </div>
</body>
</html>