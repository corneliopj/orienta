<?php
require_once __DIR__ . '/../config/functions.php';

// Processar formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    if (isset($_POST['excluir'])) {
        $pdo->prepare("DELETE FROM atendimentos WHERE id = ?")->execute([$id]);
        header('Location: atendimentos.php');
        exit;
    } else {
        $aluno_id = $_POST['aluno_id'];
        $professor_id = $_POST['professor_id'];
        $data_atendimento = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['data_atendimento'])));
        $descricao = $_POST['descricao'];
        $observacoes = $_POST['observacoes'];
        $status = $_POST['status'];
        
        if ($id) {
            $stmt = $pdo->prepare("UPDATE atendimentos SET aluno_id = ?, professor_id = ?, data_atendimento = ?, descricao = ?, observacoes = ?, status = ? WHERE id = ?");
            $stmt->execute([$aluno_id, $professor_id, $data_atendimento, $descricao, $observacoes, $status, $id]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO atendimentos (aluno_id, professor_id, data_atendimento, descricao, observacoes, status) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$aluno_id, $professor_id, $data_atendimento, $descricao, $observacoes, $status]);
        }
        header('Location: atendimentos.php');
        exit;
    }
}

require_once __DIR__ . '/../includes/header.php';

if (isset($_GET['editar'])) {
    $id = $_GET['editar'] !== '0' ? $_GET['editar'] : null;
    $atendimento = $id ? getAtendimentoById($id) : null;
    $alunos = getAlunos();
    $professores = getProfessores();
    require_once __DIR__ . '/../views/atendimento/formulario.php';
} else {
    $atendimentos = getAtendimentos();
    require_once __DIR__ . '/../views/atendimento/listar.php';
}

require_once __DIR__ . '/../includes/footer.php';