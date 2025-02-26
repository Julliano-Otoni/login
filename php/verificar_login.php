<?php
/*
 * Arquivo: verificar_login.php
 * Descrição: Verifica as credenciais do usuário e realiza o login
 * ATENÇÃO: Este é um exemplo didático. Em sistemas reais, sempre use senhas criptografadas!
 */

// Inicia a sessão
session_start();

// Inclui o arquivo de conexão com o banco
require_once 'conexao.php';

// Recebe os dados do formulário
$usuario = $_POST['username'];
$senha = $_POST['password'];

// Verifica se os campos foram preenchidos
if(empty($usuario) || empty($senha)) {
    // Redireciona de volta com mensagem de erro
    header("Location: ../index.html?erro=Preencha todos os campos");
    exit;
}

try {
    // Prepara a consulta SQL para buscar o usuário e senha
    $sql = "SELECT id, username FROM usuarios WHERE username = ? AND password = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$usuario, $senha]);
    
    // Verifica se encontrou o usuário com a senha correta
    if($stmt->rowCount() > 0) {
        // Obtém os dados do usuário
        $usuario_dados = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Cria as variáveis de sessão
        $_SESSION['user_id'] = $usuario_dados['id'];
        $_SESSION['username'] = $usuario_dados['username'];
        
        // Redireciona para o dashboard
        header("Location: ../dashboard.html");
        exit;
    } else {
        // Usuário ou senha incorretos
        header("Location: ../index.html?erro=Usuário ou senha incorretos");
        exit;
    }
} catch(PDOException $erro) {
    // Erro no banco de dados
    header("Location: ../index.html?erro=Erro no banco de dados");
    exit;
}
?> 