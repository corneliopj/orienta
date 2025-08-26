<?php
// Incluir os modelos para acessar os dados
require_once ROOT_PATH . '/models/AlunoModel.php';
require_once ROOT_PATH . '/models/ProfessorModel.php';
require_once ROOT_PATH . '/models/AtendimentoModel.php';
require_once ROOT_PATH . '/models/RelatorioModel.php';

// Instanciar os modelos
$alunoModel = new AlunoModel($pdo);
$professorModel = new ProfessorModel($pdo);
$atendimentoModel = new AtendimentoModel($pdo);
$relatorioModel = new RelatorioModel($pdo);

// --- Lógica para o Dashboard ---

// Estatísticas
$totalAlunos = $alunoModel->getTotalAlunos();
$totalAtendimentosAtivos = $atendimentoModel->getTotalAtendimentosAtivos();
$totalEventos = $atendimentoModel->getTotalEventos();
$totalRelatoriosPendentes = $relatorioModel->getTotalRelatoriosPendentes();

// Atendimentos Recentes
$itensPorPagina = 15;
$paginaAtual = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($paginaAtual - 1) * $itensPorPagina;

$atendimentos = $atendimentoModel->getAtendimentosPaginados($itensPorPagina, $offset);
$totalPaginasAtendimentos = ceil($atendimentoModel->getTotalAtendimentos() / $itensPorPagina);

// Professores Cadastrados
$professoresCadastrados = $professorModel->listarProfessores();

// Relatórios Emitidos
$relatorios = $relatorioModel->getRelatorios();

// Definir a visualização
$tituloPagina = "Dashboard";
// Definir a visualização
$viewPath = ROOT_PATH . '/views/dashboard.php';