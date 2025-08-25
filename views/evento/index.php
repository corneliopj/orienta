<?php
require_once __DIR__ . '/../config/functions.php';

$atendimento_id = $_REQUEST['atendimento_id'] ?? 0;

if (!$atendimento_id) {
    header('Location: atendimentos.php');
    exit;
}

// Processar formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $atendimento_id = $_POST['atendimento_id'];
    if (isset($_POST['excluir'])) {
        $pdo->prepare("DELETE FROM eventos WHERE id = ?")->execute([$id]);
        header('Location: eventos.php?atendimento_id=' . $atendimento_id);
        exit;
    } else {
        $data_evento = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $_POST['data_evento'])));
        $tipo = $_POST['tipo'];
        $participantes = $_POST['participantes'];
        $descricao = $_POST['descricao'];
        
        if ($id) {
            $stmt = $pdo->prepare("UPDATE eventos SET atendimento_id = ?, data_evento = ?, tipo = ?, participantes = ?, descricao = ? WHERE id = ?");
            $stmt->execute([$atendimento_id, $data_evento, $tipo, $participantes, $descricao, $id]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO eventos (atendimento_id, data_evento, tipo, participantes, descricao) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$atendimento_id, $data_evento, $tipo, $participantes, $descricao]);
        }
        header('Location: eventos.php?atendimento_id=' . $atendimento_id);
        exit;
    }
}

require_once __DIR__ . '/../includes/header.php';

if (isset($_GET['editar'])) {
    $id = $_GET['editar'] !== '0' ? $_GET['editar'] : null;
    $evento = $id ? getEventoById($id) : null;
    $atendimento = getAtendimentoById($atendimento_id);
    require_once __DIR__ . '/../views/evento/formulario.php';
} else {
    $eventos = getEventosByAtendimento($atendimento_id);
    $atendimento = getAtendimentoById($atendimento_id);
    $aluno = getAlunoById($atendimento['aluno_id']);
    require_once __DIR__ . '/../views/evento/listar.php';
}

require_once __DIR__ . '/../includes/footer.php';