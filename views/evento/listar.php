<div class="row">
    <div class="col">
        <h2 class="page-header">Gerenciamento de Eventos</h2>
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <a href="index.php?pagina=evento&acao=cadastrar" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Novo Evento</a>
        </div>
        
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title"><i class="bi bi-calendar-event"></i> Lista de Eventos</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Atendimento ID</th>
                                <th>Data</th>
                                <th>Tipo</th>
                                <th>Participantes</th>
                                <th>Descrição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($eventos)): ?>
                                <?php foreach ($eventos as $evento): ?>
                                    <tr>
                                        <td><?php echo $evento['id']; ?></td>
                                        <td><?php echo htmlspecialchars($evento['atendimento_id']); ?></td>
                                        <td><?php echo formatarData($evento['data_evento']); ?></td>
                                        <td><?php echo htmlspecialchars($evento['tipo']); ?></td>
                                        <td><?php echo htmlspecialchars($evento['participantes']); ?></td>
                                        <td><?php echo htmlspecialchars($evento['descricao']); ?></td>
                                        <td>
                                            <a href="index.php?pagina=evento&acao=editar&id=<?php echo $evento['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                            <form method="POST" name="form-delete" style="display:inline-block">
                                                <input type="hidden" name="id" value="<?php echo $evento['id']; ?>">
                                                <input type="hidden" name="excluir" value="1">
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Nenhum evento encontrado.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>