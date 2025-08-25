<div class="row">
    <div class="col">
        <h2 class="page-header">Gerenciamento de Professores</h2>
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <a href="professores.php?editar=0" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Novo Professor</a>
        </div>
        
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title"><i class="bi bi-person-badge-fill"></i> Lista de Professores</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Disciplina</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($professores as $professor): ?>
                                <tr>
                                    <td><?php echo $professor['id']; ?></td>
                                    <td><?php echo htmlspecialchars($professor['nome']); ?></td>
                                    <td><?php echo htmlspecialchars($professor['disciplina']); ?></td>
                                    <td>
                                        <a href="professores.php?editar=<?php echo $professor['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                        <form method="POST" name="form-delete" style="display:inline-block">
                                            <input type="hidden" name="id" value="<?php echo $professor['id']; ?>">
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