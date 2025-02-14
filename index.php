<?php
define('VIEW_PATH', __DIR__ . '/views/');
define('ERROR_PATH', __DIR__ . '/Page/');
require_once __DIR__ . '/Config/config_log.php';

// Obtém a URL da consulta e a sanitiza
$url = isset($_GET['url']) ? filter_var($_GET['url'], FILTER_SANITIZE_URL) : '';

// Remove qualquer caminho de diretório e sanitiza a URL
$safe_url = basename($url); 


// Verifica se a URL é a raiz
if ($url === '') {
    include ERROR_PATH . '403.php';
} elseif (file_exists($file) && is_file($file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
    // Verifica se o arquivo existe, é um arquivo regular e tem extensão .php
    include $file;
} else {
    // Registra um erro no log caso o arquivo não seja encontrado
    trigger_error("Erro 404: Página '$safe_url'", E_USER_WARNING);

    // Redireciona para a página de erro 404
    include ERROR_PATH . '404.php';
}
?>