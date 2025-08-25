<div class="row">
    <div class="col">
        <h2 class="page-header">Gerenciamento de Atendimentos</h2>
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <a href="atendimentos.php?editar=0" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Novo Atendimento</a>
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
                                <th>Data</th>
                                <th>Aluno</th>
                                <th>Professor</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($atendimentos as $at): ?>
                                <?php
                                $statusClass = $at['status'] == 'aberto' ? 'bg-warning' : 
                                              ($at['status'] == 'em_andamento' ? 'bg-info' : 'bg-success');
                                ?>
                                <tr>
                                    <td><?php echo $at['id']; ?></td>
                                    <td><?php echo formatDate($at['data_atendimento']); ?></td>
                                    <td><?php echo htmlspecialchars($at['aluno_nome']); ?></td>
                                    <td><?php echo htmlspecialchars($at['professor_nome']); ?></td>
                                    <td><span class="badge <?php echo $statusClass; ?> badge-status"><?php echo ucfirst($at['status']); ?></span></td>
                                    <td>
                                        <a href="atendimentos.php?editar=<?php echo $at['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                        <form method="POST" name="form-delete" style="display:inline-block">
                                            <input type="hidden" name="id" value="<?php echo $at['id']; ?>">
                                            <input type="hidden" name="excluir" value="1">
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                        <a href="eventos.php?atendimento_id=<?php echo $at['id']; ?>" class="btn btn-sm btn-info"><i class="bi bi-list-task"></i></a>
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