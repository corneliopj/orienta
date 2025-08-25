<?php
// Incluir o arquivo de configuração (subindo um nível para a pasta raiz do projeto)
require_once '../config/config.php';

// Definir a página padrão e a ação padrão
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 'dashboard';
$acao = isset($_GET['acao']) ? $_GET['acao'] : 'listar';

// Lógica para determinar qual arquivo de visualização carregar
$viewPath = '';
$controllerPath = '';

if ($pagina === 'dashboard') {
    // Para o dashboard, a lógica e a visualização estão em arquivos separados
    $controllerPath = '../controllers/dashboard.php';
    $viewPath = '../views/dashboard.php';
} else {
    // Para outras páginas, construimos o caminho para o arquivo de visualização
    // Exemplo: views/aluno/listar.php
    $viewPath = '../views/' . $pagina . '/' . $acao . '.php';

    // Se o arquivo da visualização não existir, voltamos para o dashboard
    if (!file_exists($viewPath)) {
        $controllerPath = '../controllers/dashboard.php';
        $viewPath = '../views/dashboard.php';
    }
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