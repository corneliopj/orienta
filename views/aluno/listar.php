<div class="row">
    <div class="col">
        <h2 class="page-header">Gerenciamento de Alunos</h2>
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <a href="./index.php?editar=0" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Novo Aluno</a>
        </div>
        
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title"><i class="bi bi-people-fill"></i> Lista de Alunos</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Matrícula</th>
                                <th>Turma</th>
                                <th>Responsável</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($alunos as $aluno): ?>
                                <tr>
                                    <td><?php echo $aluno['id']; ?></td>
                                    <td><?php echo htmlspecialchars($aluno['nome']); ?></td>
                                    <td><?php echo htmlspecialchars($aluno['matricula']); ?></td>
                                    <td><?php echo htmlspecialchars($aluno['turma']); ?></td>
                                    <td><?php echo htmlspecialchars($aluno['responsavel']); ?></td>
                                    <td>
                                        <a href="./index.php?editar=<?php echo $aluno['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                        <form method="POST" name="form-delete" style="display:inline-block">
                                            <input type="hidden" name="id" value="<?php echo $aluno['id']; ?>">
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