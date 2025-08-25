<?php
require_once __DIR__ . '/../config/functions.php';

// Processar formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    if (isset($_POST['excluir'])) {
        $pdo->prepare("DELETE FROM professores WHERE id = ?")->execute([$id]);
        header('Location: professores.php');
        exit;
    } else {
        $nome = $_POST['nome'];
        $disciplina = $_POST['disciplina'];
        
        if ($id) {
            $stmt = $pdo->prepare("UPDATE professores SET nome = ?, disciplina = ? WHERE id = ?");
            $stmt->execute([$nome, $disciplina, $id]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO professores (nome, disciplina) VALUES (?, ?)");
            $stmt->execute([$nome, $disciplina]);
        }
        header('Location: professores.php');
        exit;
    }
}

require_once __DIR__ . '/../includes/header.php';

if (isset($_GET['editar'])) {
    $id = $_GET['editar'] !== '0' ? $_GET['editar'] : null;
    $professor = $id ? getProfessorById($id) : null;
    require_once __DIR__ . '/../views/professor/formulario.php';
} else {
    $professores = getProfessores();
    require_once __DIR__ . '/../views/professor/listar.php';
}

require_once __DIR__ . '/../includes/footer.php';