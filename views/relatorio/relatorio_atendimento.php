<div class="container my-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="no-print">
                <a href="index.php?pagina=relatorio&acao=listar" class="btn btn-secondary mb-4"><i class="bi bi-arrow-left"></i> Voltar</a>
                <button onclick="window.print()" class="btn btn-success mb-4"><i class="bi bi-printer"></i> Imprimir</button>
            </div>
            
            <div class="print-header">
                <div class="text-center mb-3">
                    <img src="/public/img/logo.png" alt="Logo Orienta" class="mb-2" style="max-height: 100px;">
                    <br>
                    <h5 class="mb-0">Escola E.E.F.M Ruth Rocha</h5><br>
                    <p class="mb-0 fw-bold">Orientação Pedagógica</p>
                </div>
                <hr>
            </div>

            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Relatório do Atendimento</h4>
                    <small>ID: <?php echo htmlspecialchars($atendimento['id'] ?? ''); ?></small>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Aluno:</strong> <?php echo htmlspecialchars($atendimento['nome_aluno'] ?? ''); ?></p>
                            <p><strong>Professor:</strong> <?php echo htmlspecialchars($atendimento['nome_professor'] ?? ''); ?></p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p><strong>Data do Atendimento:</strong> <?php echo formatarData($atendimento['data_atendimento'] ?? ''); ?></p>
                            <p><strong>Status:</strong> <span class="badge bg-<?php echo ($atendimento['status'] == 'aberto') ? 'warning' : (($atendimento['status'] == 'em_andamento') ? 'info' : 'success'); ?>"><?php echo ucfirst(str_replace('_', ' ', $atendimento['status'] ?? '')); ?></span></p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <h5>Descrição do Atendimento</h5>
                    <p class="mb-4"><?php echo nl2br(htmlspecialchars($atendimento['descricao'] ?? '')); ?></p>
                    
                    <h5>Observações Gerais</h5>
                    <p class="mb-4"><?php echo nl2br(htmlspecialchars($atendimento['observacoes'] ?? '')); ?></p>
                    
                    <hr>

                    <h5>Eventos Associados</h5>
                    <?php if (!empty($atendimento['eventos'])): ?>
                        <ul class="list-group list-group-flush mb-4">
                            <?php foreach ($atendimento['eventos'] as $evento): ?>
                                <li class="list-group-item">
                                    <strong><?php echo htmlspecialchars($evento['tipo'] ?? ''); ?>:</strong> <?php echo htmlspecialchars($evento['descricao'] ?? ''); ?> (Participantes: <?php echo htmlspecialchars($evento['participantes'] ?? ''); ?>)
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <div class="alert alert-info" role="alert">Nenhum evento registrado para este atendimento.</div>
                    <?php endif; ?>
                    
                    <hr>
                    
                    <form action="index.php?pagina=relatorio&acao=salvar_relatorio" method="POST">
                        <input type="hidden" name="atendimento_id" value="<?php echo htmlspecialchars($atendimento['id'] ?? ''); ?>">
                        
                        <div class="mb-3">
                            <label for="manifestacao" class="form-label">Manifestação da Orientação</label>
                            <textarea class="form-control" id="manifestacao" name="manifestacao" rows="5"><?php echo htmlspecialchars($atendimento['manifestacao'] ?? ''); ?></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="decisao_diretor" class="form-label">Decisão da Direção</label>
                            <textarea class="form-control" id="decisao_diretor" name="decisao_diretor" rows="5"><?php echo htmlspecialchars($atendimento['decisao_diretor'] ?? ''); ?></textarea>
                        </div>
                        
                        <div class="d-flex justify-content-end no-print">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Salvar Relatório</button>
                        </div>
                    </form>
                </div>
            </div>
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
        /* Força o comportamento de duas colunas na impressão */
        .row {
            display: flex;
            flex-wrap: wrap;
        }
        .col-6 {
            width: 50%;
            float: left; /* Fallback para navegadores mais antigos */
        }
        .col-md-6 { /* Garante que a regra de duas colunas prevaleça */
            width: 50%;
        }
        .text-end {
            text-align: right !important;
        }
        .print-header {
            display: block;
            margin-bottom: 20px;
        }
    }
</style>