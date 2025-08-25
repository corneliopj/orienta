<?php
// Incluir o novo modelo de Aluno
require_once '../models/AlunoModel.php';

// Criar uma instância do modelo, passando a conexão PDO
$alunoModel = new AlunoModel($pdo);

// Lógica para Salvar, Atualizar ou Excluir (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['excluir'])) {
        $id = $_POST['id'] ?? null;
        if ($id) {
            $alunoModel->excluirAluno($id);
        }
    } else {
        $alunoModel->salvarAluno($_POST);
    }
    // Redirecionar para a página de listar após a ação
    header('Location: ../public/index.php?pagina=aluno&acao=listar');
    exit;
}

// Lógica para Exibir o Formulário (Editar ou Novo) - GET
if ($acao === 'formulario') {
    $id = $_GET['id'] ?? null;
    $aluno = null;
    if ($id) {
        $aluno = $alunoModel->getAlunoById($id);
    }
    $viewPath = '../views/aluno/formulario.php';
} else {
    // Lógica para Exibir a Lista de Alunos - GET
    $alunos = $alunoModel->getAlunos();
    $viewPath = '../views/aluno/listar.php';
}

// A variável $viewPath é usada no index.php para carregar a view correta.