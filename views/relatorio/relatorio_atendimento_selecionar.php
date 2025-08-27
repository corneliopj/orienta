<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Relatórios e Atendimentos</h2>
            <p class="text-muted">
                Para criar um novo relatório, selecione um atendimento da lista. Para visualizar um relatório já gerado, clique em "Visualizar" na lista de relatórios.
            </p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Relatórios Já Gerados</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Aluno</th>
                                    <th>Professor</th>
                                    <th>Data do Atendimento</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($relatorios_gerados)): ?>
                                    <?php foreach ($relatorios_gerados as $relatorio): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($relatorio['nome_aluno']); ?></td>
                                            <td><?php echo htmlspecialchars($relatorio['nome_professor']); ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($relatorio['data_atendimento'])); ?></td>
                                            <td class="no-print">
                                                <a href="index.php?pagina=relatorio&acao=atendimento&id=<?php echo htmlspecialchars($relatorio['id']); ?>" class="btn btn-sm btn-primary" title="Visualizar Relatório">
                                                    <i class="bi bi-eye"></i> Visualizar
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Nenhum relatório gerado encontrado.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Atendimentos Pendentes de Relatório</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Aluno</th>
                                    <th>Professor</th>
                                    <th>Data do Atendimento</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($atendimentos_para_relatorio)): ?>
                                    <?php foreach ($atendimentos_para_relatorio as $atendimento): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($atendimento['nome_aluno']); ?></td>
                                            <td><?php echo htmlspecialchars($atendimento['nome_professor']); ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($atendimento['data_atendimento'])); ?></td>
                                            <td class="no-print">
                                                <a href="index.php?pagina=relatorio&acao=atendimento&id=<?php echo htmlspecialchars($atendimento['id']); ?>" class="btn btn-sm btn-success" title="Criar Relatório">
                                                    <i class="bi bi-file-earmark-plus"></i> Criar Relatório
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Nenhum atendimento pendente de relatório encontrado.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>