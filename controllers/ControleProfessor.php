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
            'email' => $_POST['email'],
            'telefone' => $_POST['telefone'],
            'observacoes' => $_POST['observacoes']
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

switch ($acao) {
    case 'listar':
        $professores = $professorModel->listarProfessores();
        include ROOT_PATH . '/views/professor/listar.php';
        break;
    
    case 'cadastrar':
        include ROOT_PATH . '/views/professor/formulario.php';
        break;
        
    case 'editar':
        $id = $_GET['id'] ?? null;
        $professor = $professorModel->getProfessorById($id);
        include ROOT_PATH . '/views/professor/formulario.php';
        break;
        
    default:
        // Caso a ação não seja encontrada, redireciona para a lista
        header("Location: index.php?pagina={$pagina}&acao=listar");
        break;
}