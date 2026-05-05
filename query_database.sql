CREATE DATABASE IF NOT EXISTS autopecas_db;
USE autopecas_db;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

-- Insere usuário com hash MD5 temporário (será atualizado no passo 4)
INSERT INTO usuarios(usuario, senha) VALUES('admin', MD5('123456'));

CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_peca VARCHAR(50) NOT NULL UNIQUE,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL,
    quantidade_estoque INT NOT NULL DEFAULT 0,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- atualização:
-- UPDATE usuarios SET senha = 'COLE_A_HASH_AQUI' WHERE usuario = 'admin';
-- criar arquivo temporário gerar_senha.php com esse código: <?php echo password_hash('123456', PASSWORD_DEFAULT); ?> (após rodar corretamente excluir gerar_senha.php imediatamente)