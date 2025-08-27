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

switch ($acao) {
    case 'atendimento':
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $atendimentos_para_relatorio = $atendimentoModel->listarAtendimentosPendentes();
            $relatorios_gerados = $atendimentoModel->listarRelatoriosExistentes();
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
            $alunos = $alunoModel->listarAlunos();
            $viewPath = ROOT_PATH . '/views/relatorio/relatorio_dossie_selecionar.php';
        } else {
            $dossie = $alunoModel->getDossieAluno($id);
            $viewPath = ROOT_PATH . '/views/relatorio/relatorio_dossie.php';
        }
        break;

    case 'salvar_relatorio':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $atendimento_id = $_POST['atendimento_id'] ?? null;
            $manifestacao = $_POST['manifestacao'] ?? '';
            $decisao_diretor = $_POST['decisao_diretor'] ?? '';

            if ($atendimentoModel->atualizarCamposRelatorio($atendimento_id, $manifestacao, $decisao_diretor)) {
                header("Location: index.php?pagina=relatorio&acao=atendimento&id=$atendimento_id&status=sucesso");
                exit();
            } else {
                header("Location: index.php?pagina=relatorio&acao=atendimento&id=$atendimento_id&status=erro");
                exit();
            }
        }
        break;
        
    case 'listar':
    default:
        $viewPath = ROOT_PATH . '/views/relatorio/listar.php';
        break;
}