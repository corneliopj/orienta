<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Relatórios e Atendimentos</h2>
        </div>
    </div>

    <ul class="nav nav-tabs" id="relatorioTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pendentes-tab" data-bs-toggle="tab" data-bs-target="#pendentes" type="button" role="tab" aria-controls="pendentes" aria-selected="true">
                Relatórios Pendentes
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="gerados-tab" data-bs-toggle="tab" data-bs-target="#gerados" type="button" role="tab" aria-controls="gerados" aria-selected="false">
                Relatórios Gerados
            </button>
        </li>
    </ul>

    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="pendentes" role="tabpanel" aria-labelledby="pendentes-tab">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Atendimentos Pendentes de Relatório</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th># Atendimento</th>
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
                                            <td><?php echo htmlspecialchars($atendimento['id']); ?></td>
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
                                        <td colspan="5" class="text-center">Nenhum atendimento pendente de relatório encontrado.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="gerados" role="tabpanel" aria-labelledby="gerados-tab">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Relatórios Já Gerados</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th># Atendimento</th>
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
                                            <td><?php echo htmlspecialchars($relatorio['id']); ?></td>
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
                                        <td colspan="5" class="text-center">Nenhum relatório gerado encontrado.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <nav>
                <ul class="pagination justify-content-center mt-3 no-print">
                    <?php if ($total_paginas > 1): ?>
                        <li class="page-item <?php echo ($pagina_atual == 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="index.php?pagina=relatorio&acao=atendimento&p=<?php echo $pagina_atual - 1; ?>" tabindex="-1" aria-disabled="true">Anterior</a>
                        </li>
                        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                            <li class="page-item <?php echo ($i == $pagina_atual) ? 'active' : ''; ?>">
                                <a class="page-link" href="index.php?pagina=relatorio&acao=atendimento&p=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?php echo ($pagina_atual == $total_paginas) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="index.php?pagina=relatorio&acao=atendimento&p=<?php echo $pagina_atual + 1; ?>">Próxima</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>