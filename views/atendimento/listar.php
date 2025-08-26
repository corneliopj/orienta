<div class="row">
    <div class="col">
        <h2 class="page-header">Gerenciamento de Atendimentos</h2>
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <a href="index.php?pagina=atendimento&acao=cadastrar" class="btn btn-primary"><i class="bi bi-journal-plus"></i> Novo Atendimento</a>
        </div>
        
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title"><i class="bi bi-journal-text"></i> Lista de Atendimentos</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Aluno</th>
                                <th>Professor</th>
                                <th>Data</th>
                                <th>Descrição</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($atendimentos) > 0): ?>
                                <?php foreach ($atendimentos as $atendimento): ?>
                                    <tr>
                                        <td><?php echo $atendimento['id']; ?></td>
                                        <td><?php echo htmlspecialchars($atendimento['nome_aluno']); ?></td>
                                        <td><?php echo htmlspecialchars($atendimento['nome_professor']); ?></td>
                                        <td><?php echo formatarData($atendimento['data_atendimento']); ?></td>
                                        <td><?php echo htmlspecialchars($atendimento['descricao']); ?></td>
                                        <td>
                                            <span class="badge rounded-pill bg-<?php echo ($atendimento['status'] == 'aberto') ? 'warning' : (($atendimento['status'] == 'em_andamento') ? 'info' : 'success'); ?>">
                                                <?php echo ucfirst(str_replace('_', ' ', $atendimento['status'])); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="index.php?pagina=atendimento&acao=editar&id=<?php echo $atendimento['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                            <form method="POST" name="form-delete" style="display:inline-block">
                                                <input type="hidden" name="id" value="<?php echo $atendimento['id']; ?>">
                                                <input type="hidden" name="excluir" value="1">
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php if (!empty($atendimento['eventos'])): ?>
                                        <tr>
                                            <td colspan="7">
                                                <div class="d-flex align-items-center mb-1 ms-4"><i class="bi bi-calendar-event me-2"></i> Eventos relacionados:</div>
                                                <ul class="list-group list-group-flush ms-5">
                                                    <?php foreach ($atendimento['eventos'] as $evento): ?>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center py-1">
                                                            <div>
                                                                **Evento ID <?php echo $evento['id']; ?>:** <?php echo htmlspecialchars($evento['titulo']); ?>
                                                                <small class="text-muted d-block"><?php echo htmlspecialchars($evento['descricao']); ?></small>
                                                            </div>
                                                            <div>
                                                                <a href="index.php?pagina=evento&acao=editar&id=<?php echo $evento['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i> Editar</a>
                                                                <form method="POST" name="form-delete" style="display:inline-block">
                                                                    <input type="hidden" name="id" value="<?php echo $evento['id']; ?>">
                                                                    <input type="hidden" name="excluir" value="1">
                                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Excluir</button>
                                                                </form>
                                                            </div>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Nenhum atendimento encontrado.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>