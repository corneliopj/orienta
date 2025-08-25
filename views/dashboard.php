<div class="main-content">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="chart-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Atendimentos Recentes</h5>
                    <a href="#" class="btn btn-sm btn-outline-primary">Ver Todos</a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Aluno</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Data</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($atendimentos as $atendimento): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($atendimento['id']); ?></td>
                                <td><?php echo htmlspecialchars($atendimento['aluno_nome']); ?></td>
                                <td><?php echo htmlspecialchars($atendimento['descricao']); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($atendimento['data_atendimento'])); ?></td>
                                <td>
                                    <?php
                                        $statusClass = '';
                                        switch ($atendimento['status']) {
                                            case 'aberto':
                                                $statusClass = 'badge-status bg-info text-dark';
                                                break;
                                            case 'em_andamento':
                                                $statusClass = 'badge-status bg-warning text-dark';
                                                break;
                                            case 'concluido':
                                                $statusClass = 'badge-status bg-success';
                                                break;
                                            default:
                                                $statusClass = 'badge-status bg-secondary';
                                                break;
                                        }
                                    ?>
                                    <span class="<?php echo $statusClass; ?>"><?php echo htmlspecialchars($atendimento['status']); ?></span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <nav>
                    <ul class="pagination justify-content-center">
                        <?php for ($i = 1; $i <= $totalPaginasAtendimentos; $i++): ?>
                            <li class="page-item <?php echo ($i == $paginaAtual) ? 'active' : ''; ?>">
                                <a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="chart-container">
                <h5 class="mb-4">Professores Cadastrados</h5>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Disciplina</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($professores as $professor): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($professor['id']); ?></td>
                                <td><?php echo htmlspecialchars($professor['nome']); ?></td>
                                <td><?php echo htmlspecialchars($professor['disciplina']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="chart-container">
                <h5 class="mb-4">Relatórios Emitidos</h5>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Origem</th>
                                <th scope="col">Aluno</th>
                                <th scope="col">Data</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($relatorios as $relatorio): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($relatorio['id']); ?></td>
                                <td><?php echo htmlspecialchars($relatorio['origem_caso']); ?></td>
                                <td><?php echo htmlspecialchars($relatorio['aluno_nome']); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($relatorio['data_relatorio'])); ?></td>
                                <td><?php echo htmlspecialchars($relatorio['status']); ?></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-info" target="_blank"><i class="bi bi-printer"></i> Imprimir</a>
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