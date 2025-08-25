<?php require_once __DIR__ . '/../../includes/header.php'; ?>
<div class="no-print mb-3">
    <button class="btn btn-primary" onclick="window.print()"><i class="bi bi-printer"></i> Imprimir Relatório</button>
    <a href="relatorios.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
</div>

<div class="print-only">
    <div class="container-fluid">
        <div class="text-center mb-4">
            <h1>RELATÓRIO DE ACOMPANHAMENTO EDUCACIONAL</h1>
            <h3>Sistema de Acompanhamento Educacional</h3>
            <p>Relatório #<?php echo $relatorio['id']; ?> - Emitido em <?php echo date('d/m/Y'); ?></p>
        </div>
        
        <div class="row mb-3">
            <div class="col-6">
                <h5>Dados do Aluno</h5>
                <p><strong>Nome:</strong> <?php echo htmlspecialchars($aluno['nome']); ?></p>
                <p><strong>Matrícula:</strong> <?php echo htmlspecialchars($aluno['matricula']); ?></p>
                <p><strong>Turma:</strong> <?php echo htmlspecialchars($aluno['turma']); ?></p>
            </div>
            <div class="col-6">
                <h5>Dados do Atendimento</h5>
                <p><strong>Professor:</strong> <?php echo htmlspecialchars($professor['nome']); ?></p>
                <p><strong>Data do Atendimento:</strong> <?php echo formatDate($atendimento['data_atendimento']); ?></p>
                <p><strong>Status:</strong> <?php echo ucfirst($relatorio['status']); ?></p>
            </div>
        </div>
        
        <hr>
        
        <h5 class="mb-2">Origem do Caso</h5>
        <div class="report-section mb-3">
            <?php echo nl2br(htmlspecialchars($relatorio['origem_caso'])); ?>
        </div>
        
        <h5 class="mb-2">Manifestação da Orientação</h5>
        <div class="report-section mb-3">
            <?php echo nl2br(htmlspecialchars($relatorio['manifestacao'])); ?>
        </div>
        
        <h5 class="mb-2">Histórico de Eventos (Ordem Cronológica)</h5>
        <?php if (!empty($eventos)): ?>
            <div class="list-group mb-3">
                <?php $eventos_cronologicos = array_reverse($eventos); ?>
                <?php foreach ($eventos_cronologicos as $evento): ?>
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Tipo: <?php echo ucfirst($evento['tipo']); ?></h6>
                            <small class="text-muted">Data: <?php echo formatDateTime($evento['data_evento']); ?></small>
                        </div>
                        <?php if (!empty($evento['participantes'])): ?>
                            <p class="mb-1">Participantes: <?php echo htmlspecialchars($evento['participantes']); ?></p>
                        <?php endif; ?>
                        <p class="mb-1">Descrição:</p>
                        <p class="mb-1 fst-italic text-secondary"><?php echo nl2br(htmlspecialchars($evento['descricao'])); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">Nenhum evento registrado para este atendimento.</div>
        <?php endif; ?>
        
        <?php if (!empty($relatorio['decisao_diretor'])): ?>
            <h5 class="mb-2">Decisão da Direção</h5>
            <div class="report-section mb-3">
                <?php echo nl2br(htmlspecialchars($relatorio['decisao_diretor'])); ?>
            </div>
        <?php endif; ?>
        
        <div class="assinaturas">
            <div class="d-flex justify-content-between">
                <div class="text-center">
                    <p>_________________________________________</p>
                    <p>Orientador Educacional</p>
                </div>
                
                <div class="text-center">
                    <p>_________________________________________</p>
                    <p>Diretor</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css" media="print">
    @page {
        size: A4;
        margin: 1cm;
    }
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 9pt;
        line-height: 1.3;
    }
    h1 {
        font-size: 16pt;
        margin-bottom: 8px;
    }
    h3 {
        font-size: 12pt;
        margin-bottom: 6px;
    }
    h5 {
        font-size: 11pt;
        margin-top: 10px;
        margin-bottom: 5px;
    }
    p {
        margin-bottom: 0.5rem;
    }
    .report-section {
        padding: 6px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        white-space: pre-wrap;
    }
    .list-group-item {
        padding: 8px 12px;
        margin-bottom: 5px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
    }
    .list-group-item:last-child {
        margin-bottom: 0;
    }
    .d-flex {
        display: flex;
    }
    .justify-content-between {
        justify-content: space-between;
    }
    .text-center {
        text-align: center;
    }
    .row {
        display: flex;
        margin-left: -5px;
        margin-right: -5px;
    }
    .col-6 {
        flex: 0 0 auto;
        width: 70%;
        padding-left: 5px;
        padding-right: 5px;
    }
    .assinaturas {
        margin-top: 2rem;
    }
    .assinaturas .text-center {
        width: 45%;
    }
    .no-print {
        display: none !important;
    }
    .print-only {
        display: block !important;
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }
    .container-fluid {
        width: 100%;
        padding-right: var(--bs-gutter-x, 0.75rem);
        padding-left: var(--bs-gutter-x, 0.75rem);
    }
</style>
<?php require_once __DIR__ . '/../../includes/footer.php'; ?>