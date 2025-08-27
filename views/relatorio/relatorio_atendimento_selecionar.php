<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Relatórios e Atendimentos</h2>
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
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Relatórios Já Gerados</h5>
                </div>
                <div class="card-body">
                    <?php 
                        $relatorios_por_aba = 25;
                        $relatorios_por_pagina = array_chunk($relatorios_gerados, $relatorios_por_aba);
                        $total_abas = count($relatorios_por_pagina);
                    ?>

                    <?php if ($total_abas > 0): ?>
                        <ul class="nav nav-tabs" id="relatoriosTabs" role="tablist">
                            <?php foreach ($relatorios_por_pagina as $indice => $relatorios): ?>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link <?php echo ($indice === 0) ? 'active' : ''; ?>" id="tab-<?php echo $indice; ?>" data-bs-toggle="tab" data-bs-target="#pagina-<?php echo $indice; ?>" type="button" role="tab" aria-controls="pagina-<?php echo $indice; ?>" aria-selected="<?php echo ($indice === 0) ? 'true' : 'false'; ?>">
                                        Página <?php echo $indice + 1; ?>
                                    </button>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="tab-content mt-3">
                            <?php foreach ($relatorios_por_pagina as $indice => $relatorios): ?>
                                <div class="tab-pane fade <?php echo ($indice === 0) ? 'show active' : ''; ?>" id="pagina-<?php echo $indice; ?>" role="tabpanel" aria-labelledby="tab-<?php echo $indice; ?>">
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
                                                <?php foreach ($relatorios as $relatorio): ?>
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
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info" role="alert">
                            Nenhum relatório gerado encontrado.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>