<div class="container my-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="no-print">
                <a href="index.php?pagina=relatorio&acao=listar" class="btn btn-secondary mb-4"><i class="bi bi-arrow-left"></i> Voltar</a>
                <button onclick="window.print()" class="btn btn-success mb-4"><i class="bi bi-printer"></i> Imprimir</button>
            </div>

            <div class="print-header">
                <div class="text-center mb-3">
                    <img src="/orienta/public/img/logo.png" alt="Logo Orienta" class="mb-2" style="max-height: 50px;">
                    <h5 class="mb-0">Escola Estadual de Ensino Fundamental e Médio Ruth Rocha</h5>
                    <p class="mb-0 fw-bold">Orientação Pedagógica</p>
                </div>
                <hr>
            </div>
            
            <?php if (!empty($dossie)): ?>
            <div class="card shadow mb-4">
                <div class="card-header bg-secondary text-white text-center">
                    <h4 class="mb-0">Dossiê do Aluno: <?php echo htmlspecialchars($dossie['nome'] ?? ''); ?></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Matrícula:</strong> <?php echo htmlspecialchars($dossie['matricula'] ?? ''); ?></p>
                            <p><strong>Turma:</strong> <?php echo htmlspecialchars($dossie['turma'] ?? ''); ?></p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p><strong>Responsável:</strong> <?php echo htmlspecialchars($dossie['responsavel'] ?? ''); ?></p>
                            <p><strong>Telefone:</strong> <?php echo htmlspecialchars($dossie['telefone'] ?? ''); ?></p>
                        </div>
                    </div>
                    <hr>
                    <h5>Histórico de Atendimentos</h5>
                    <?php if (!empty($dossie['atendimentos'])): ?>
                        <?php foreach ($dossie['atendimentos'] as $atendimento): ?>
                            <div class="card bg-light mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">Atendimento ID <?php echo htmlspecialchars($atendimento['id'] ?? ''); ?> (<?php echo formatarData($atendimento['data_atendimento'] ?? ''); ?>)</h6>
                                    <p class="card-text"><strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($atendimento['descricao'] ?? '')); ?></p>
                                    
                                    <?php if (!empty($atendimento['eventos'])): ?>
                                        <hr class="my-2">
                                        <small class="text-muted">Eventos:</small>
                                        <ul class="list-unstyled">
                                            <?php foreach ($atendimento['eventos'] as $evento): ?>
                                                <li>- <strong><?php echo htmlspecialchars($evento['tipo'] ?? ''); ?>:</strong> <?php echo htmlspecialchars($evento['descricao'] ?? ''); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-info">Nenhum atendimento registrado para este aluno.</div>
                    <?php endif; ?>
                </div>
            </div>
            <?php else: ?>
                <div class="alert alert-danger text-center">Dossiê não encontrado. Verifique o ID do aluno.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
<style>
    .print-header {
        display: none;
    }
    @media print {
        .no-print {
            display: none !important;
        }
        body {
            background-color: #fff !important;
            margin: 0 !important;
            padding: 0 !important;
            font-size: 10pt;
            line-height: 1.2;
        }
        .container, .container-fluid, .col-md-10 {
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .card, .card-header, .card-body {
            border: none !important;
            box-shadow: none !important;
        }
        p, ul, li {
            text-align: justify;
        }
        .print-header {
            display: block;
            margin-bottom: 20px;
        }
    }
</style>