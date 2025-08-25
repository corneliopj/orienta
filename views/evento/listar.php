<div class="row">
    <div class="col">
        <h2 class="page-header">Eventos de Acompanhamento</h2>
        
        <div class="d-flex justify-content-between mb-3">
            <div>
                <h4>Atendimento #<?php echo $atendimento_id; ?> - <?php echo htmlspecialchars($aluno['nome']); ?></h4>
                <p class="text-muted"><?php echo formatDate($atendimento['data_atendimento']); ?> - <?php echo ucfirst($atendimento['status']); ?></p>
            </div>
            <div>
                <a href="eventos.php?atendimento_id=<?php echo $atendimento_id; ?>&editar=0" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Novo Evento</a>
                <a href="atendimentos.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
            </div>
        </div>
        
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title"><i class="bi bi-list-task"></i> Registro de Eventos</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Data/Hora</th>
                                <th>Tipo</th>
                                <th>Participantes</th>
                                <th>Descrição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($eventos as $evento): ?>
                                <tr>
                                    <td><?php echo formatDateTime($evento['data_evento']); ?></td>
                                    <td><?php echo ucfirst($evento['tipo']); ?></td>
                                    <td><?php echo htmlspecialchars($evento['participantes']); ?></td>
                                    <td><?php echo nl2br(htmlspecialchars(mb_strimwidth($evento['descricao'], 0, 100, '...'))); ?></td>
                                    <td>
                                        <a href="eventos.php?atendimento_id=<?php echo $atendimento_id; ?>&editar=<?php echo $evento['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                        <form method="POST" name="form-delete" style="display:inline-block">
                                            <input type="hidden" name="id" value="<?php echo $evento['id']; ?>">
                                            <input type="hidden" name="atendimento_id" value="<?php echo $atendimento_id; ?>">
                                            <input type="hidden" name="excluir" value="1">
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>