-- Arquivo: database.sql
-- Descrição: Cria o banco de dados e a tabela de usuários
-- ATENÇÃO: Este é um exemplo didático. Nunca use senhas em texto puro em sistemas reais!

-- Cria o banco de dados se não existir
CREATE DATABASE IF NOT EXISTS sistema_login;

-- Seleciona o banco de dados
USE sistema_login;

-- Cria a tabela de usuários
CREATE TABLE IF NOT EXISTS usuarios (
    -- Identificador único do usuário
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    -- Nome de usuário (único)
    username VARCHAR(50) NOT NULL UNIQUE,
    
    -- Senha em texto puro (apenas para fins didáticos!)
    password VARCHAR(50) NOT NULL,
    
    -- E-mail do usuário (único)
    email VARCHAR(100) NOT NULL UNIQUE,
    
    -- Data e hora do cadastro
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insere um usuário administrador inicial
-- ATENÇÃO: Em sistemas reais, nunca armazene senhas desta forma!
INSERT INTO usuarios (username, password, email) VALUES 
('admin', 'admin123', 'admin@exemplo.com');

-- Cria um índice para busca rápida por username
CREATE INDEX idx_username ON usuarios(username);

-- Cria um índice para busca rápida por email
CREATE INDEX idx_email ON usuarios(email); 