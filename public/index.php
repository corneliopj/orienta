<?php
// Carregar arquivos de configuração e classes
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/functions.php'; // Manter temporariamente para formatação de data
require_once __DIR__ . '/../../models/AlunoModel.php';

// Definir a página e ação padrão
$pagina = $_GET['pagina'] ?? 'dashboard';
$acao = $_GET['acao'] ?? 'listar';

$viewPath = '';
$controllerPath = '';

switch ($pagina) {
    case 'dashboard':
        $viewPath = '../views/dashboard.php';
        break;
    case 'aluno':
        $controllerPath = '../controllers/ControleAlunos.php';
        break;
    // Adicionar outros casos aqui para professores, atendimentos, etc.
    // case 'professor':
    //     $controllerPath = '../controllers/ControleProfessores.php';
    //     break;
    default:
        $viewPath = '../views/dashboard.php';
}

// Incluir o cabeçalho
require_once __DIR__ . '/../../includes/header.php';

// Carregar o controlador, se houver
if (!empty($controllerPath) && file_exists($controllerPath)) {
    require_once $controllerPath;
}

// Carregar a visualização
if (!empty($viewPath) && file_exists($viewPath)) {
    require_once $viewPath;
}

// Incluir o rodapé
require_once __DIR__ . '/../../includes/footer.php';