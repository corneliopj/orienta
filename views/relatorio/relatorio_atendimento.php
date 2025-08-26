<div class="container my-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="no-print">
                <a href="index.php?pagina=relatorio&acao=listar" class="btn btn-secondary mb-4"><i class="bi bi-arrow-left"></i> Voltar</a>
                <button onclick="window.print()" class="btn btn-success mb-4"><i class="bi bi-printer"></i> Imprimir</button>
            </div>
            
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Relatório do Atendimento</h4>
                    <small>ID: <?php echo $atendimento['id']; ?></small>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Aluno:</strong> <?php echo htmlspecialchars($atendimento['nome_aluno']); ?></p>
                            <p><strong>Professor:</strong> <?php echo htmlspecialchars($atendimento['nome_professor']); ?></p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p><strong>Data do Atendimento:</strong> <?php echo formatarData($atendimento['data_atendimento']); ?></p>
                            <p><strong>Status:</strong> <span class="badge bg-<?php echo ($atendimento['status'] == 'aberto') ? 'warning' : (($atendimento['status'] == 'em_andamento') ? 'info' : 'success'); ?>"><?php echo ucfirst(str_replace('_', ' ', $atendimento['status'])); ?></span></p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <h5>Descrição do Atendimento</h5>
                    <p class="mb-4"><?php echo nl2br(htmlspecialchars($atendimento['descricao'])); ?></p>
                    
                    <h5>Observações Gerais</h5>
                    <p class="mb-4"><?php echo nl2br(htmlspecialchars($atendimento['observacoes'])); ?></p>
                    
                    <hr>

                    <h5>Eventos Associados</h5>
                    <?php if (!empty($atendimento['eventos'])): ?>
                        <ul class="list-group list-group-flush mb-4">
                            <?php foreach ($atendimento['eventos'] as $evento): ?>
                                <li class="list-group-item">
                                    <strong><?php echo htmlspecialchars($evento['tipo']); ?>:</strong> <?php echo htmlspecialchars($evento['descricao']); ?> (Participantes: <?php echo htmlspecialchars($evento['participantes']); ?>)
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <div class="alert alert-info" role="alert">Nenhum evento registrado para este atendimento.</div>
                    <?php endif; ?>
                    
                    <hr>
                    
                    <form action="index.php?pagina=relatorio&acao=atendimento" method="POST">
                        <input type="hidden" name="atendimento_id" value="<?php echo $atendimento['id']; ?>">
                        
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
     @media print {
    /* Esconde elementos de navegação */
    .no-print {
        display: none !important;
    }

    /* Remove margens e preenchimentos do corpo da página */
    body {
        background-color: #fff !important; /* Fundo branco, como em um documento */
        margin: 0 !important;
        padding: 0 !important;
        font-size: 10pt;
    }

    /* Expande o conteúdo para a largura total, removendo as margens do container */
    .container, .container-fluid {
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    /* Remove a margem lateral da coluna */
    .col-md-10 {
        padding: 0 !important;
    }

    /* Remove bordas e sombras para uma aparência de documento limpo */
    .card, .card-header, .card-body {
        border: none !important;
        box-shadow: none !important;
    }
    
    /* Torna o cabeçalho de impressão visível */
    .print-header {
        display: block;
        margin-bottom: 20px;
    }
}
</style>
