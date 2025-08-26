<div class="row">
    <div class="col">
        <h2 class="page-header">Gerenciamento de Professores</h2>
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <a href="index.php?pagina=professor&acao=cadastrar" class="btn btn-primary"><i class="bi bi-person-plus"></i> Novo Professor</a>
        </div>
        
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title"><i class="bi bi-person-badge"></i> Lista de Professores</h3>
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
                            <?php if (count($professores) > 0): ?>
                                <?php foreach ($professores as $professor): ?>
                                    <tr>
                                        <td><?php echo $professor['id']; ?></td>
                                        <td><?php echo htmlspecialchars($professor['nome']); ?></td>
                                        <td><?php echo htmlspecialchars($professor['disciplina']); ?></td>
                                        <td>
                                            <a href="index.php?pagina=professor&acao=editar&id=<?php echo $professor['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                            <form method="POST" name="form-delete" style="display:inline-block">
                                                <input type="hidden" name="id" value="<?php echo $professor['id']; ?>">
                                                <input type="hidden" name="excluir" value="1">
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">Nenhum professor encontrado.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>