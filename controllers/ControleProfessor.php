<?php
require_once ROOT_PATH . '/models/ProfessorModel.php';

$professorModel = new ProfessorModel($pdo);
$pagina = 'professor';
$acao = $_GET['acao'] ?? 'listar';
$professor = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    
    if (isset($_POST['excluir'])) {
        $professorModel->excluirProfessor($id);
        header("Location: index.php?pagina={$pagina}&acao=listar");
        exit;
    } else {
        $dados = [
            'nome' => $_POST['nome'],
            'disciplina' => $_POST['disciplina'] ?? null
        ];

        if ($id) {
            $professorModel->atualizarProfessor($id, $dados);
        } else {
            $professorModel->salvarProfessor($dados);
        }
        
        header("Location: index.php?pagina={$pagina}&acao=listar");
        exit;
    }
}

// AQUI VEM A CORREÇÃO
switch ($acao) {
    case 'listar':
        $professores = $professorModel->listarProfessores();
        $viewPath = ROOT_PATH . '/views/professor/listar.php'; // APENAS ATRIBUI O CAMINHO
        break;
    
    case 'cadastrar':
        $viewPath = ROOT_PATH . '/views/professor/formulario.php'; // APENAS ATRIBUI O CAMINHO
        break;
        
    case 'editar':
        $id = $_GET['id'] ?? null;
        $professor = $professorModel->getProfessorById($id);
        $viewPath = ROOT_PATH . '/views/professor/formulario.php'; // APENAS ATRIBUI O CAMINHO
        break;
        
    default:
        // Caso a ação não seja encontrada, redireciona para a lista
        header("Location: index.php?pagina={$pagina}&acao=listar");
        break;
}