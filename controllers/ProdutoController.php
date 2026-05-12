<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header("Location:../views/login.php");
    exit;
}
require_once '../models/Produto.php';

$acao = $_GET['acao'] ?? 'dashboard';
$produtoModel = new Produto();

if ($acao == 'dashboard') {
    require_once '../views/dashboard.php';
} elseif ($acao == 'listar') {
        // Coleta os filtros do formulário (GET)
        $filtros = [
            'nome' => $_GET['nome'] ?? '',
            'codigo' => $_GET['codigo'] ?? '',
            'estoque_min' => $_GET['estoque_min'] ?? '',
            'estoque_max' => $_GET['estoque_max'] ?? '',
            'preco_min' => $_GET['preco_min'] ?? '',
            'preco_max' => $_GET['preco_max'] ?? '',
        ];
        
        // Remove filtros vazios para não atrapalhar a query
        $filtros = array_filter($filtros, function($v) { return $v !== ''; });
        
        $produtos = $produtoModel->listarFiltrados($filtros);
        require_once '../views/produto_list.php';
} elseif ($acao == 'novo') {
    require_once '../views/produto_form.php';
} elseif ($acao == 'editar') {
    $id = $_GET['id'];
    $produto = $produtoModel->buscarPorId($id);
    require_once '../views/produto_form.php';
} elseif ($acao == 'salvar') {
    $id = $_POST['id'];
    $codigo = $_POST['codigo_peca'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $estoque = $_POST['quantidade_estoque'];

    if (empty($id)) {
        $produtoModel->cadastrar($codigo, $nome, $descricao, $preco, $estoque);
    } else {
        // Atualização não implementada no PDF, mantido conforme instrução original
    }
    header("Location:../controllers/ProdutoController.php?acao=listar");
    exit;
} elseif ($acao == 'excluir') {
    $id = $_GET['id'];
    $produtoModel->deletar($id);
    header("Location:../controllers/ProdutoController.php?acao=listar");
    exit;
}
?>