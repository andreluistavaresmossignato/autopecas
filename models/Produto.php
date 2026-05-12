<?php
require_once '../config/database.php';

class Produto
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function listarTodos()
    {
        $query = "SELECT * FROM produtos ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($codigo, $nome, $descricao, $preco, $estoque)
    {
        $query = "INSERT INTO produtos(codigo_peca, nome, descricao, preco, quantidade_estoque) VALUES(:codigo,:nome,:descricao,:preco,:estoque)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':estoque', $estoque);
        return $stmt->execute();
    }

    public function buscarPorId($id)
    {
        $query = "SELECT * FROM produtos WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deletar($id)
    {
        $query = "DELETE FROM produtos WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // ✅ Novo método: listar com filtros
    public function listarFiltrados($filtros = [])
    {
        $query = "SELECT * FROM produtos WHERE 1=1";
        $params = [];

        // Filtro por nome (busca parcial)
        if (!empty($filtros['nome'])) {
            $query .= " AND nome LIKE :nome";
            $params[':nome'] = "%{$filtros['nome']}%";
        }

        // Filtro por código da peça
        if (!empty($filtros['codigo'])) {
            $query .= " AND codigo_peca LIKE :codigo";
            $params[':codigo'] = "%{$filtros['codigo']}%";
        }

        // Filtro por estoque mínimo
        if (isset($filtros['estoque_min']) && $filtros['estoque_min'] !== '') {
            $query .= " AND quantidade_estoque >= :estoque_min";
            $params[':estoque_min'] = (int)$filtros['estoque_min'];
        }

        // Filtro por estoque máximo
        if (isset($filtros['estoque_max']) && $filtros['estoque_max'] !== '') {
            $query .= " AND quantidade_estoque <= :estoque_max";
            $params[':estoque_max'] = (int)$filtros['estoque_max'];
        }

        // Filtro por preço mínimo
        if (isset($filtros['preco_min']) && $filtros['preco_min'] !== '') {
            $query .= " AND preco >= :preco_min";
            $params[':preco_min'] = (float)$filtros['preco_min'];
        }

        // Filtro por preço máximo
        if (isset($filtros['preco_max']) && $filtros['preco_max'] !== '') {
            $query .= " AND preco <= :preco_max";
            $params[':preco_max'] = (float)$filtros['preco_max'];
        }

        $query .= " ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);

        // Bind dos parâmetros dinamicamente
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 📊 Estatísticas gerais do estoque
    public function getEstatisticas()
    {
        $stats = [];

        // Total de produtos
        $query = "SELECT COUNT(*) as total FROM produtos";
        $stmt = $this->conn->query($query);
        $stats['total_produtos'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Valor total do estoque (preço * quantidade)
        $query = "SELECT SUM(preco * quantidade_estoque) as valor_total FROM produtos";
        $stmt = $this->conn->query($query);
        $stats['valor_estoque'] = $stmt->fetch(PDO::FETCH_ASSOC)['valor_total'] ?? 0;

        // Preço médio
        $query = "SELECT AVG(preco) as preco_medio FROM produtos";
        $stmt = $this->conn->query($query);
        $stats['preco_medio'] = $stmt->fetch(PDO::FETCH_ASSOC)['preco_medio'] ?? 0;

        // Produtos com estoque baixo (< 5)
        $query = "SELECT COUNT(*) as baixo_estoque FROM produtos WHERE quantidade_estoque < 5";
        $stmt = $this->conn->query($query);
        $stats['baixo_estoque'] = $stmt->fetch(PDO::FETCH_ASSOC)['baixo_estoque'];

        return $stats;
    }

    // 📈 Dados para gráfico: nome, preço e estoque de todos os produtos
    public function getDadosGrafico()
    {
        $query = "SELECT nome, preco, quantidade_estoque FROM produtos ORDER BY nome LIMIT 20";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ⚠️ Produtos que precisam de reposição (estoque < 5)
    public function getProdutosReposicao()
    {
        $query = "SELECT id, nome, codigo_peca, quantidade_estoque, preco 
                  FROM produtos 
                  WHERE quantidade_estoque < 5 
                  ORDER BY quantidade_estoque ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

        // ✅ Método para atualizar produto no banco
    public function atualizar($id, $codigo, $nome, $descricao, $preco, $estoque) {
        $query = "UPDATE produtos SET 
                    codigo_peca = :codigo,
                    nome = :nome,
                    descricao = :descricao,
                    preco = :preco,
                    quantidade_estoque = :estoque
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':estoque', $estoque);
        
        return $stmt->execute();
    }
}
