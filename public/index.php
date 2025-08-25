
<?php
// Incluir o arquivo de configuração e a lógica do controlador do dashboard
require_once '../config/config.php';
require_once '../controllers/dashboard.php';

// Roteamento simples baseado no parâmetro 'pagina'
$view = 'dashboard'; // A visão padrão é o dashboard

if (isset($_GET['pagina'])) {
    $pagina = $_GET['pagina'];

    // Verifique se o arquivo da visão existe antes de incluir
    $viewPath = '../views/' . $pagina . '.php';
    if (file_exists($viewPath)) {
        $view = $pagina;
    } else {
        // Opcional: Redirecionar para uma página de erro ou para o dashboard
        // Por enquanto, vamos manter o dashboard como padrão caso a página não exista
        $view = 'dashboard';
    }
}

// Carrega as partes do layout
require_once '../includes/header.php';
require_once '../includes/sidebar.php';

// Inclui a visão selecionada
require_once '../views/' . $view . '/listar.php';

// Inclui o rodapé
require_once '../includes/footer.php';
?>