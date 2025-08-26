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

// Roteamento para os controladores
switch ($pagina) {
    case 'dashboard':
        require_once ROOT_PATH . '/controllers/ControleDashboard.php';
        break;
        
    case 'aluno':
        require_once ROOT_PATH . '/controllers/ControleAluno.php';
        break;
        
    case 'professor':
        require_once ROOT_PATH . '/controllers/ControleProfessor.php';
        break;
        
    case 'atendimento':
        // Lógica para o controlador de atendimentos
        // require_once ROOT_PATH . '/controllers/ControleAtendimento.php';
        break;
        
    case 'evento':
        // Lógica para o controlador de eventos
        // require_once ROOT_PATH . '/controllers/ControleEvento.php';
        break;
        
    case 'relatorio':
        // Lógica para o controlador de relatórios
        // require_once ROOT_PATH . '/controllers/ControleRelatorio.php';
        break;
    
    default:
        // Se a página não for encontrada, redireciona para a dashboard
        header("Location: index.php?pagina=dashboard");
        exit();
}

// Incluir o cabeçalho
require_once ROOT_PATH . '/includes/header.php';
require_once ROOT_PATH . '/includes/sidebar.php';




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