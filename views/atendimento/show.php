<div class="row">
    <div class="col-md-10 offset-md-1">
        <h2 class="page-header">Detalhes do Atendimento</h2>

        <?php if (!empty($atendimento)): ?>
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-person-fill"></i> Atendimento de <?php echo htmlspecialchars($atendimento['nome_aluno']); ?></h5>
                    <div>
                        <a href="index.php?pagina=atendimento&acao=editar&id=<?php echo $atendimento['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i> Editar</a>
                        <form method="POST" name="form-delete-atendimento" style="display:inline-block">
                            <input type="hidden" name="id" value="<?php echo $atendimento['id']; ?>">
                            <input type="hidden" name="excluir" value="1">
                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Excluir</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <p><strong>Professor Responsável:</strong> <?php echo htmlspecialchars($atendimento['nome_professor']); ?></p>
                    <p><strong>Data:</strong> <?php echo formatarData($atendimento['data_atendimento']); ?></p>
                    <p><strong>Status:</strong> <span class="badge rounded-pill bg-<?php echo ($atendimento['status'] == 'aberto') ? 'warning' : (($atendimento['status'] == 'em_andamento') ? 'info' : 'success'); ?>">
                        <?php echo ucfirst(str_replace('_', ' ', $atendimento['status'])); ?>
                    </span></p>
                    <p><strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($atendimento['descricao'])); ?></p>
                    <p><strong>Observações:</strong> <?php echo nl2br(htmlspecialchars($atendimento['observacoes'])); ?></p>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-calendar-event"></i> Eventos Associados</h5>
                    <a href="index.php?pagina=evento&acao=cadastrar&atendimento_id=<?php echo $atendimento['id']; ?>" class="btn btn-sm btn-light text-success"><i class="bi bi-plus-circle"></i> Novo Evento</a>
                </div>
                <div class="card-body">
                    <?php if (!empty($atendimento['eventos'])): ?>
                        <div class="accordion" id="eventosAccordion">
                            <?php foreach ($atendimento['eventos'] as $evento): ?>
                                <div class="accordion-item mb-2">
                                    <h2 class="accordion-header" id="headingEvento<?php echo $evento['id']; ?>">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEvento<?php echo $evento['id']; ?>" aria-expanded="false" aria-controls="collapseEvento<?php echo $evento['id']; ?>">
                                            Evento: <?php echo htmlspecialchars($evento['tipo']); ?> - <?php echo formatarData($evento['data_evento']); ?>
                                        </button>
                                    </h2>
                                    <div id="collapseEvento<?php echo $evento['id']; ?>" class="accordion-collapse collapse" aria-labelledby="headingEvento<?php echo $evento['id']; ?>" data-bs-parent="#eventosAccordion">
                                        <div class="accordion-body">
                                            <p><strong>Participantes:</strong> <?php echo htmlspecialchars($evento['participantes']); ?></p>
                                            <p><strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($evento['descricao'])); ?></p>
                                            <div class="mt-3">
                                                <a href="index.php?pagina=evento&acao=editar&id=<?php echo $evento['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i> Editar Evento</a>
                                                <form method="POST" name="form-delete-evento" style="display:inline-block">
                                                    <input type="hidden" name="id" value="<?php echo $evento['id']; ?>">
                                                    <input type="hidden" name="excluir_evento" value="1">
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Excluir Evento</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info text-center">Nenhum evento associado a este atendimento.</div>
                    <?php endif; ?>
                </div>
            </div>
            
            <a href="index.php?pagina=atendimento&acao=listar" class="btn btn-secondary mt-4"><i class="bi bi-arrow-left"></i> Voltar para a lista</a>

        <?php else: ?>
            <div class="alert alert-danger text-center">Atendimento não encontrado.</div>
        <?php endif; ?>
    </div>
</div>