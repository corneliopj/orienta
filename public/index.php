<?php
// Incluir o arquivo de configuração (subindo um nível para a pasta raiz do projeto)
require_once '../config/config.php';

// Definir a página padrão e a ação padrão
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 'dashboard';
$acao = isset($_GET['acao']) ? $_GET['acao'] : 'listar';



// Lógica para carregar o controlador e a visualização
$viewPath = '';
$controllerPath = '';

switch ($pagina) {
    case 'dashboard':
        $controllerPath = '../controllers/dashboard.php';
        $viewPath = '../views/dashboard.php';
        break;
    case 'aluno':
        $controllerPath = '../controllers/ControleAlunos.php';
        // A lógica de qual view carregar está dentro do controlador
        break;
    // ... (outros casos)
    default:
        $controllerPath = '../controllers/dashboard.php';
        $viewPath = '../views/dashboard.php';
}

// Carregar o controlador, se houver
if (!empty($controllerPath) && file_exists($controllerPath)) {
    require_once $controllerPath;
}



// Carregar o layout e a visualização
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
require_once $viewPath;
require_once '../includes/footer.php';
?>