<div class="row">
    <div class="col">
        <h2 class="page-header">Gerenciamento de Relatórios</h2>

        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title"><i class="bi bi-file-earmark-plus"></i> Gerar Novo Relatório</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="relatorios.php">
                    <input type="hidden" name="editar" value="0">
                    <div class="row align-items-end">
                        <div class="col-md-9 mb-3">
                            <label class="form-label">Selecione um Atendimento</label>
                            <select class="form-select" name="atendimento_id" required>
                                <option value="">Escolha o atendimento para gerar o relatório</option>
                                <?php foreach ($atendimentos as $atendimento): ?>
                                    <option value="<?php echo $atendimento['id']; ?>">
                                        #<?php echo $atendimento['id']; ?> - Aluno: <?php echo htmlspecialchars($atendimento['aluno_nome']); ?> (<?php echo formatDate($atendimento['data_atendimento']); ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-plus-circle"></i> Gerar Relatório</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title"><i class="bi bi-file-earmark-text"></i> Relatórios Gerados</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Data</th>
                                <th>Atendimento</th>
                                <th>Aluno</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($relatorios as $rel): ?>
                                <?php
                                $statusClass = $rel['status'] == 'pendente' ? 'bg-warning' : 
                                              ($rel['status'] == 'aprovado' ? 'bg-success' : 'bg-danger');
                                ?>
                                <tr>
                                    <td><?php echo $rel['id']; ?></td>
                                    <td><?php echo formatDate($rel['data_relatorio']); ?></td>
                                    <td>#<?php echo $rel['atendimento_id']; ?></td>
                                    <td><?php echo htmlspecialchars($rel['aluno_nome']); ?></td>
                                    <td><span class="badge <?php echo $statusClass; ?> badge-status"><?php echo ucfirst($rel['status']); ?></span></td>
                                    <td>
                                        <a href="relatorios.php?editar=<?php echo $rel['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                        <form method="POST" name="form-delete" style="display:inline-block">
                                            <input type="hidden" name="id" value="<?php echo $rel['id']; ?>">
                                            <input type="hidden" name="excluir" value="1">
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                        <a href="relatorios.php?imprimir=<?php echo $rel['id']; ?>" class="btn btn-sm btn-info" target="_blank"><i class="bi bi-printer"></i></a>
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