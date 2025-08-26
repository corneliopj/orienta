<?php
// Incluir os modelos necessários
require_once ROOT_PATH . '/models/AtendimentoModel.php';
require_once ROOT_PATH . '/models/AlunoModel.php';
require_once ROOT_PATH . '/models/EventoModel.php';

// Instanciar os modelos
$atendimentoModel = new AtendimentoModel($pdo);
$alunoModel = new AlunoModel($pdo);

$pagina = 'relatorio';
$acao = $_GET['acao'] ?? 'listar';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $acao === 'atendimento') {
    $atendimento_id = $_POST['atendimento_id'];
    $dados = [
        'manifestacao' => $_POST['manifestacao'],
        'decisao_diretor' => $_POST['decisao_diretor']
    ];

    $atendimentoModel->atualizarCamposRelatorio($atendimento_id, $dados);

    header("Location: index.php?pagina={$pagina}&acao=atendimento&id={$atendimento_id}");
    exit;
}

switch ($acao) {
    case 'atendimento':
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $atendimentos = $atendimentoModel->listarAtendimentos(); // Para a lista de seleção
            $viewPath = ROOT_PATH . '/views/relatorio/relatorio_atendimento_selecionar.php';
        } else {
            $atendimento = $atendimentoModel->getAtendimentoComEventosById($id);
            if (!$atendimento) {
                header("Location: index.php?pagina=atendimento&acao=listar");
                exit;
            }
            $viewPath = ROOT_PATH . '/views/relatorio/relatorio_atendimento.php';
        }
        break;

    case 'dossie':
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $alunos = $alunoModel->listarAlunos(); // Para a lista de seleção
            $viewPath = ROOT_PATH . '/views/relatorio/relatorio_dossie_selecionar.php';
        } else {
            $dossie = $alunoModel->getDossieAluno($id);
            $viewPath = ROOT_PATH . '/views/relatorio/relatorio_dossie.php';
        }
        break;
    
    case 'listar':
    default:
        $viewPath = ROOT_PATH . '/views/relatorio/listar.php';
        break;
}