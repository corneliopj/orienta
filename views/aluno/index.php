<?php
require_once __DIR__ . '/../../config/functions.php';

// Processar formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    if (isset($_POST['excluir'])) {
        $pdo->prepare("DELETE FROM alunos WHERE id = ?")->execute([$id]);
        header('Location: alunos.php');
        exit;
    } else {
        $nome = $_POST['nome'];
        $matricula = $_POST['matricula'];
        $data_nascimento = !empty($_POST['data_nascimento']) ? date('Y-m-d', strtotime(str_replace('/', '-', $_POST['data_nascimento']))) : null;
        $turma = $_POST['turma'];
        $responsavel = $_POST['responsavel'];
        $telefone = $_POST['telefone'];
        $observacoes = $_POST['observacoes'];
        
        if ($id) {
            $stmt = $pdo->prepare("UPDATE alunos SET nome = ?, matricula = ?, data_nascimento = ?, turma = ?, responsavel = ?, telefone = ?, observacoes = ? WHERE id = ?");
            $stmt->execute([$nome, $matricula, $data_nascimento, $turma, $responsavel, $telefone, $observacoes, $id]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO alunos (nome, matricula, data_nascimento, turma, responsavel, telefone, observacoes) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nome, $matricula, $data_nascimento, $turma, $responsavel, $telefone, $observacoes]);
        }
        header('Location: alunos.php');
        exit;
    }
}

require_once __DIR__ . '/../../includes/header.php';

if (isset($_GET['editar'])) {
    $id = $_GET['editar'] !== '0' ? $_GET['editar'] : null;
    $aluno = $id ? getAlunoById($id) : null;
    require_once __DIR__ . './formulario.php';
} else {
    $alunos = getAlunos();
    require_once __DIR__ . './listar.php';
}

require_once __DIR__ . '/../../includes/footer.php';