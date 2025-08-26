<?php
// Incluir o modelo de eventos
require_once ROOT_PATH . '/models/EventoModel.php';

// Instanciar o modelo
$eventoModel = new EventoModel($pdo);

$pagina = 'evento';
$acao = $_GET['acao'] ?? 'listar';
$evento = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    
    if (isset($_POST['excluir'])) {
        $eventoModel->excluirEvento($id);
        header("Location: index.php?pagina={$pagina}&acao=listar");
        exit;
    } else {
        $dados = [
            'atendimento_id' => $_POST['atendimento_id'],
            'data_evento' => $_POST['data_evento'],
            'tipo' => $_POST['tipo'],
            'participantes' => $_POST['participantes'],
            'descricao' => $_POST['descricao'] ?? null
        ];

        if ($id) {
            $eventoModel->atualizarEvento($id, $dados);
        } else {
            $eventoModel->salvarEvento($dados);
        }
        
        header("Location: index.php?pagina={$pagina}&acao=listar");
        exit;
    }
}

switch ($acao) {
    case 'listar':
        $eventos = $eventoModel->listarEventos();
        $viewPath = ROOT_PATH . '/views/evento/listar.php';
        break;
    
    case 'cadastrar':
        $viewPath = ROOT_PATH . '/views/evento/formulario.php';
        break;
        
    case 'editar':
        $id = $_GET['id'] ?? null;
        $evento = $eventoModel->getEventoById($id);
        $viewPath = ROOT_PATH . '/views/evento/formulario.php';
        break;
        
    default:
        header("Location: index.php?pagina={$pagina}&acao=listar");
        exit;
}