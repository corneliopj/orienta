<?php
require_once __DIR__ . '/../config/functions.php';

// Processar formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    if (isset($_POST['excluir'])) {
        $pdo->prepare("DELETE FROM relatorios WHERE id = ?")->execute([$id]);
        header('Location: relatorios.php');
        exit;
    } else {
        $atendimento_id = $_POST['atendimento_id'];
        $data_relatorio = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['data_relatorio'])));
        $origem_caso = $_POST['origem_caso'];
        $resumo_eventos = $_POST['resumo_eventos'];
        $manifestacao = $_POST['manifestacao'];
        $decisao_diretor = $_POST['decisao_diretor'];
        $status = $_POST['status'];
        
        if ($id) {
            $stmt = $pdo->prepare("UPDATE relatorios SET atendimento_id = ?, data_relatorio = ?, origem_caso = ?, resumo_eventos = ?, manifestacao = ?, decisao_diretor = ?, status = ? WHERE id = ?");
            $stmt->execute([$atendimento_id, $data_relatorio, $origem_caso, $resumo_eventos, $manifestacao, $decisao_diretor, $status, $id]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO relatorios (atendimento_id, data_relatorio, origem_caso, resumo_eventos, manifestacao, decisao_diretor, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$atendimento_id, $data_relatorio, $origem_caso, $resumo_eventos, $manifestacao, $decisao_diretor, $status]);
        }
        header('Location: relatorios.php');
        exit;
    }
}

require_once __DIR__ . '/../includes/header.php';

if (isset($_GET['editar'])) {
    $id = $_GET['editar'] !== '0' ? $_GET['editar'] : null;
    $relatorio = $id ? getRelatorioById($id) : null;
    $atendimento_id = $relatorio ? $relatorio['atendimento_id'] : ($_GET['atendimento_id'] ?? 0);
    $atendimento = $atendimento_id ? getAtendimentoById($atendimento_id) : null;
    
    if (!$atendimento) {
        echo '<div class="alert alert-danger">Atendimento não encontrado.</div>';
    } else {
        $aluno = getAlunoById($atendimento['aluno_id']);
        $professor = getProfessorById($atendimento['professor_id']);
        
        // Se for um novo relatório, gera o resumo de eventos automaticamente
        if (!$id) {
            $eventos = getEventosByAtendimento($atendimento_id);
            // Ordena os eventos por data ascendente para o resumo
            $eventos_cronologicos = array_reverse($eventos);
            $resumo_eventos_automatico = '';
            foreach ($eventos_cronologicos as $evento) {
                $resumo_eventos_automatico .= "- " . formatDateTime($evento['data_evento']) . " | Tipo: " . ucfirst($evento['tipo']) . "\n";
                if (!empty($evento['participantes'])) {
                    $resumo_eventos_automatico .= "  Participantes: " . htmlspecialchars($evento['participantes']) . "\n";
                }
                $resumo_eventos_automatico .= "  Descrição: " . htmlspecialchars($evento['descricao']) . "\n\n";
            }
        }
        
        require_once __DIR__ . '/../views/relatorio/formulario.php';
    }

} elseif (isset($_GET['imprimir'])) {
    $id = $_GET['imprimir'];
    $relatorio = getRelatorioById($id);
    if ($relatorio) {
        $atendimento = getAtendimentoById($relatorio['atendimento_id']);
        $aluno = getAlunoById($atendimento['aluno_id']);
        $professor = getProfessorById($atendimento['professor_id']);
        $eventos = getEventosByAtendimento($atendimento['id']);
        require_once __DIR__ . '/../views/relatorio/imprimir.php';
    } else {
        echo '<div class="alert alert-danger">Relatório não encontrado.</div>';
    }
} else {
    $relatorios = getRelatorios();
    $atendimentos = getAtendimentosParaRelatorio(); // Nova função para o dropdown
    require_once __DIR__ . '/../views/relatorio/listar.php';
}

require_once __DIR__ . '/../includes/footer.php';