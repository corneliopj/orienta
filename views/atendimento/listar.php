<div class="row">
    <div class="col">
        <h2 class="page-header">Gerenciamento de Atendimentos</h2>
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <a href="index.php?pagina=atendimento&acao=cadastrar" class="btn btn-primary"><i class="bi bi-journal-plus"></i> Novo Atendimento</a>
        </div>
        
        <div class="accordion" id="accordionAtendimentos">
            <?php if (!empty($atendimentos)): ?>
                <?php foreach ($atendimentos as $index => $atendimento): ?>
                    <div class="accordion-item shadow-sm mb-3">
                        <h2 class="accordion-header" id="heading<?php echo $atendimento['id']; ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $atendimento['id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $atendimento['id']; ?>">
                                <div class="row w-100">
                                    <div class="col-md-3"><strong>Aluno:</strong> <?php echo htmlspecialchars($atendimento['nome_aluno']); ?></div>
                                    <div class="col-md-3"><strong>Professor:</strong> <?php echo htmlspecialchars($atendimento['nome_professor']); ?></div>
                                    <div class="col-md-3"><strong>Data:</strong> <?php echo formatarData($atendimento['data_atendimento']); ?></div>
                                    <div class="col-md-3"><strong>Status:</strong> <span class="badge rounded-pill bg-<?php echo ($atendimento['status'] == 'aberto') ? 'warning' : (($atendimento['status'] == 'em_andamento') ? 'info' : 'success'); ?>">
                                            <?php echo ucfirst(str_replace('_', ' ', $atendimento['status'])); ?>
                                        </span>
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse<?php echo $atendimento['id']; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $atendimento['id']; ?>" data-bs-parent="#accordionAtendimentos">
                            <div class="accordion-body">
                                <div class="card mb-3">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i> Detalhes do Atendimento</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($atendimento['descricao'])); ?></p>
                                        <div class="mt-3">
                                            <a href="index.php?pagina=atendimento&acao=editar&id=<?php echo $atendimento['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i> Editar Atendimento</a>
                                            <form method="POST" name="form-delete" style="display:inline-block">
                                                <input type="hidden" name="id" value="<?php echo $atendimento['id']; ?>">
                                                <input type="hidden" name="excluir" value="1">
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Excluir Atendimento</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0"><i class="bi bi-calendar-event me-2"></i> Eventos Relacionados</h5>
                                        <a href="index.php?pagina=evento&acao=cadastrar&atendimento_id=<?php echo $atendimento['id']; ?>" class="btn btn-sm btn-success"><i class="bi bi-plus-circle"></i> Novo Evento</a>
                                    </div>
                                    <div class="card-body">
                                        <?php if (!empty($atendimento['eventos'])): ?>
                                            <ul class="list-group">
                                                <?php foreach ($atendimento['eventos'] as $evento): ?>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h6 class="mb-1">Evento ID <?php echo $evento['id']; ?></h6>
                                                            <p class="mb-0 text-muted"><?php echo htmlspecialchars($evento['descricao']); ?></p>
                                                        </div>
                                                        <div>
                                                            <a href="index.php?pagina=evento&acao=editar&id=<?php echo $evento['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                                            <form method="POST" name="form-delete-evento" style="display:inline-block">
                                                                <input type="hidden" name="id" value="<?php echo $evento['id']; ?>">
                                                                <input type="hidden" name="excluir_evento" value="1">
                                                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                                            </form>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php else: ?>
                                            <div class="alert alert-info" role="alert">
                                                Nenhum evento encontrado para este atendimento.
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-info text-center" role="alert">
                    Nenhum atendimento encontrado.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>