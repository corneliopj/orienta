<?php
require_once __DIR__ . '/config.php';

// Funções de formatação de data
function formatDate($date, $format = 'd/m/Y') {
    if (empty($date) || $date === '0000-00-00') {
        return '';
    }
    $d = new DateTime($date);
    return $d->format($format);
}
function formatarData($data)
{
    if (!$data || $data === '0000-00-00 00:00:00') {
        return 'N/A';
    }
    return date('d/m/Y', strtotime($data));
}

function formatDateTime($datetime, $format = 'd/m/Y H:i') {
    if (empty($datetime) || $datetime === '0000-00-00 00:00:00') {
        return '';
    }
    $d = new DateTime($datetime);
    return $d->format($format);
}

// Funções de acesso ao banco de dados (GETTERS)
function getAlunos() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM alunos ORDER BY nome");
    return $stmt->fetchAll();
}

function getAlunoById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM alunos WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function getProfessores() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM professores ORDER BY nome");
    return $stmt->fetchAll();
}

function getProfessorById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM professores WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function getAtendimentos() {
    global $pdo;
    $stmt = $pdo->query("
        SELECT a.id, a.data_atendimento, a.status, 
               al.nome as aluno_nome, p.nome as professor_nome 
        FROM atendimentos a
        JOIN alunos al ON a.aluno_id = al.id
        JOIN professores p ON a.professor_id = p.id
        ORDER BY a.data_atendimento DESC
    ");
    return $stmt->fetchAll();
}

function getAtendimentosParaRelatorio() {
    global $pdo;
    $stmt = $pdo->query("
        SELECT a.id, a.data_atendimento, al.nome as aluno_nome
        FROM atendimentos a
        JOIN alunos al ON a.aluno_id = al.id
        ORDER BY a.data_atendimento DESC
    ");
    return $stmt->fetchAll();
}

function getAtendimentoById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM atendimentos WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function getEventosByAtendimento($atendimento_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM eventos WHERE atendimento_id = ? ORDER BY data_evento DESC");
    $stmt->execute([$atendimento_id]);
    return $stmt->fetchAll();
}

function getEventoById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM eventos WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function getRelatorios() {
    global $pdo;
    $stmt = $pdo->query("
        SELECT r.id, r.data_relatorio, r.status,
               a.id as atendimento_id, al.nome as aluno_nome
        FROM relatorios r
        JOIN atendimentos a ON r.atendimento_id = a.id
        JOIN alunos al ON a.aluno_id = al.id
        ORDER BY r.data_relatorio DESC
    ");
    return $stmt->fetchAll();
}

function getRelatorioById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM relatorios WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}