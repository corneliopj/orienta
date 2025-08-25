<?php
// Define o caminho raiz do projeto
define('ROOT_PATH', __DIR__ . '/..');

// Carregar arquivos de configuração e classes
require_once ROOT_PATH . '/config/config.php';
require_once ROOT_PATH . '/config/functions.php'; // Manter temporariamente para formatação de data

// Definir a página e ação padrão
$pagina = $_GET['pagina'] ?? 'dashboard';
$acao = $_GET['acao'] ?? 'listar';

$viewPath = '';
$controllerPath = '';

switch ($pagina) {
    case 'dashboard':
        $controllerPath = ROOT_PATH . '/controllers/ControleDashboard.php';
        break;
    case 'aluno':
        $controllerPath = ROOT_PATH . '/controllers/ControleAlunos.php';
        break;
    // Adicionar outros casos aqui para professores, atendimentos, etc.
    default:
        $controllerPath = ROOT_PATH . '/controllers/ControleDashboard.php';
        break;
}

// Incluir o cabeçalho
require_once ROOT_PATH . '/includes/header.php';


// Carregar o controlador, se houver
if (!empty($controllerPath) && file_exists($controllerPath)) {
    require_once $controllerPath;
}

// Carregar a visualização
if (!empty($viewPath) && file_exists($viewPath)) {
    require_once $viewPath;
} else if ($pagina === 'dashboard') {
    // Se a view não for definida pelo controlador (ex: dashboard), carrega aqui
    require_once ROOT_PATH . '/views/dashboard.php';
}

// Incluir o rodapé
require_once ROOT_PATH . '/includes/footer.php';