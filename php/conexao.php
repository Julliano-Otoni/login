<?php
/*
 * Arquivo: conexao.php
 * Descrição: Arquivo responsável pela conexão com o banco de dados MySQL
 * Este arquivo deve ser incluído em todas as páginas que precisam acessar o banco
 */

// Dados de conexão com o banco
$servidor = 'localhost';     // Endereço do servidor
$banco = 'sistema_login';    // Nome do banco de dados
$usuario = 'root';          // Nome do usuário
$senha = '';                // Senha do usuário

// Tenta realizar a conexão com o banco de dados
try {
    // Cria a conexão usando PDO
    $conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
    
    // Configura o PDO para lançar exceções em caso de erros
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Configura o charset para UTF8
    $conexao->exec("SET CHARACTER SET utf8");
    
} catch(PDOException $erro) {
    // Em caso de erro, exibe a mensagem
    die("Erro na conexão com o banco de dados: " . $erro->getMessage());
}
?> 