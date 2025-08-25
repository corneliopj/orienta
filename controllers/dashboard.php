<?php
// Define o limite de itens por página
$itensPorPagina = 15;

// Obtém o número da página atual a partir da URL
$paginaAtual = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($paginaAtual - 1) * $itensPorPagina;

// Consultar o total de atendimentos para a paginação
$stmtTotalAtendimentos = $pdo->query("SELECT COUNT(*) FROM atendimentos");
$totalAtendimentos = $stmtTotalAtendimentos->fetchColumn();
$totalPaginasAtendimentos = ceil($totalAtendimentos / $itensPorPagina);

// Consultar os atendimentos, unindo com a tabela de alunos para obter o nome
$stmtAtendimentos = $pdo->prepare("SELECT a.id, al.nome as aluno_nome, a.descricao, a.data_atendimento, a.status FROM atendimentos a JOIN alunos al ON a.aluno_id = al.id ORDER BY a.data_atendimento DESC LIMIT :limit OFFSET :offset");
$stmtAtendimentos->bindValue(':limit', $itensPorPagina, PDO::PARAM_INT);
$stmtAtendimentos->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmtAtendimentos->execute();
$atendimentos = $stmtAtendimentos->fetchAll();

// Consultar os professores
$stmtProfessores = $pdo->query("SELECT * FROM professores ORDER BY nome");
$professores = $stmtProfessores->fetchAll();

// Consultar os relatórios
$stmtRelatorios = $pdo->query("SELECT r.id, r.origem_caso, r.data_relatorio, a.nome as aluno_nome, r.status FROM relatorios r JOIN atendimentos at ON r.atendimento_id = at.id JOIN alunos a ON at.aluno_id = a.id ORDER BY r.data_relatorio DESC");
$relatorios = $stmtRelatorios->fetchAll();
?>