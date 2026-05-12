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
        public function listarFiltrados($filtros = []) {
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
}
?>