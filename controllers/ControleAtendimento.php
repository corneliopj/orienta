<?php
require_once ROOT_PATH . '/models/AtendimentoModel.php';
require_once ROOT_PATH . '/models/AlunoModel.php';
require_once ROOT_PATH . '/models/ProfessorModel.php';

$atendimentoModel = new AtendimentoModel($pdo);
$alunoModel = new AlunoModel($pdo);
$professorModel = new ProfessorModel($pdo);

$pagina = 'atendimento';
$acao = $_GET['acao'] ?? 'listar';
$atendimento = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    
    if (isset($_POST['excluir'])) {
        $atendimentoModel->excluirAtendimento($id);
        header("Location: index.php?pagina={$pagina}&acao=listar");
        exit;
    } else {
        $dados = [
            'aluno_id' => $_POST['aluno_id'],
            'professor_id' => $_POST['professor_id'],
            'data_atendimento' => $_POST['data_atendimento'],
            'descricao' => $_POST['descricao'] ?? null,
            'status' => $_POST['status'],
            'observacoes' => $_POST['observacoes'] ?? null
        ];

        if ($id) {
            $atendimentoModel->atualizarAtendimento($id, $dados);
        } else {
            $atendimentoModel->salvarAtendimento($dados);
        }
        
        header("Location: index.php?pagina={$pagina}&acao=listar");
        exit;
    }
}

// O controlador apenas define a visualização, não a inclui
switch ($acao) {
    case 'listar':
        $atendimentos = $atendimentoModel->listarAtendimentos();
        $viewPath = ROOT_PATH . '/views/atendimento/listar.php'; // Apenas define o caminho
        break;
    
    case 'cadastrar':
        $alunos = $alunoModel->listarAlunos();
        $professores = $professorModel->listarProfessores();
        $viewPath = ROOT_PATH . '/views/atendimento/formulario.php';
        break;
        
    case 'editar':
        $id = $_GET['id'] ?? null;
        $atendimento = $atendimentoModel->getAtendimentoById($id);
        $alunos = $alunoModel->listarAlunos();
        $professores = $professorModel->listarProfessores();
        $viewPath = ROOT_PATH . '/views/atendimento/formulario.php';
        break;
        
    default:
        header("Location: index.php?pagina={$pagina}&acao=listar");
        exit;
}