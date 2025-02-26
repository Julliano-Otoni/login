<?php
/*
 * Arquivo: cadastrar_usuario.php
 * Descrição: Cadastra um novo usuário no sistema
 * ATENÇÃO: Este é um exemplo didático. Em sistemas reais, sempre use senhas criptografadas!
 */

// Inicia a sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html?erro=Usuário não autorizado");
    exit;
}

// Inclui o arquivo de conexão
require_once 'conexao.php';

// Recebe os dados do formulário
$novo_usuario = $_POST['novo_usuario'];
$nova_senha = $_POST['nova_senha'];
$email = $_POST['email'];

// Verifica se todos os campos foram preenchidos
if(empty($novo_usuario) || empty($nova_senha) || empty($email)) {
    header("Location: ../dashboard.html?mensagem=Preencha todos os campos");
    exit;
}

try {
    // Verifica se o usuário ou email já existem
    $sql = "SELECT id FROM usuarios WHERE username = ? OR email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$novo_usuario, $email]);
    
    if($stmt->rowCount() > 0) {
        // Usuário ou email já cadastrados
        header("Location: ../dashboard.html?mensagem=Usuário ou e-mail já cadastrados");
        exit;
    }

    // Prepara e executa a inserção do novo usuário
    // ATENÇÃO: Em sistemas reais, nunca armazene a senha desta forma!
    $sql = "INSERT INTO usuarios (username, password, email) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$novo_usuario, $nova_senha, $email]);

    // Redireciona com mensagem de sucesso
    header("Location: ../dashboard.html?mensagem=Usuário cadastrado com sucesso!");
    exit;

} catch(PDOException $erro) {
    // Em caso de erro, redireciona com mensagem de erro
    header("Location: ../dashboard.html?mensagem=Erro ao cadastrar: " . $erro->getMessage());
    exit;
}
?> 