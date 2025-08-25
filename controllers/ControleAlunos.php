<?php

// Incluir o novo modelo
require_once '../models/AlunoModel.php';

// Criar uma instância do modelo, passando a conexão PDO
$alunoModel = new AlunoModel($pdo);

// Lógica para Salvar, Atualizar ou Excluir
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['excluir'])) {
        $id = $_POST['id'] ?? null;
        if ($id) {
            $alunoModel->excluirAluno($id);
        }
    } else {
        $alunoModel->salvarAluno($_POST);
    }
    header('Location: index.php?pagina=aluno&acao=listar');
    exit;
}

// Lógica para Exibir o Formulário (Editar ou Novo)
if (isset($_GET['acao']) && $_GET['acao'] === 'formulario') {
    $id = $_GET['id'] ?? null;
    $aluno = null;
    if ($id) {
        $aluno = $alunoModel->getAlunoById($id);
    }
    $viewPath = '../views/aluno/formulario.php';
} else {
    // Lógica para Exibir a Lista de Alunos
    $alunos = $alunoModel->getAlunos();
    $viewPath = '../views/aluno/listar.php';
}