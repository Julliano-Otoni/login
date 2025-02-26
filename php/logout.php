<?php
/*
 * Arquivo: logout.php
 * Descrição: Encerra a sessão do usuário e redireciona para a página de login
 */

// Inicia a sessão
session_start();

// Destroi todas as variáveis da sessão
$_SESSION = array();

// Destroi a sessão
session_destroy();

// Redireciona para a página de login
header("Location: ../index.html");
exit;
?> 