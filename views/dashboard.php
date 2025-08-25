<?php
// Certifique-se de que a conexão com o banco de dados está incluída aqui
require_once __DIR__ . '/../config/functions.php';

// Inicialize as variáveis antes de usá-las para evitar avisos
$totalAtendimentos = $pdo->query('SELECT COUNT(*) FROM atendimentos')->fetchColumn();
$totalProfessores = $pdo->query('SELECT COUNT(*) FROM professores')->fetchColumn();
$limit = 5; // Defina o limite de itens por página
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

$offset = ($pagina - 1) * $limit;
?>
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="stat-card card text-primary primary">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <i class="stat-icon bi bi-journal-check me-3"></i>
                    <div>
                        <div class="fw-bold text-uppercase mb-1">Total de Atendimentos</div>
                        <div class="h5 mb-0 fw-bold"><?php echo $totalAtendimentos; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="stat-card card text-success success">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <i class="stat-icon bi bi-file-earmark-text me-3"></i>
                    <div>
                        <div class="fw-bold text-uppercase mb-1">Atendimentos Ativos</div>
                        <div class="h5 mb-0 fw-bold"><?php echo $totalAtendimentosAtivos; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="stat-card card text-info info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <i class="stat-icon bi bi-calendar-event me-3"></i>
                    <div>
                        <div class="fw-bold text-uppercase mb-1">Eventos</div>
                        <div class="h5 mb-0 fw-bold"><?php echo $totalEventos; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="stat-card card text-warning warning">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <i class="stat-icon bi bi-person-badge me-3"></i>
                    <div>
                        <div class="fw-bold text-uppercase mb-1">Professores</div>
                        <div class="h5 mb-0 fw-bold"><?php echo $totalProfessores; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                                <td><?php echo htmlspecialchars(substr($atendimento['descricao'], 0, 100)) . '...'; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($atendimento['data_atendimento'])); ?></td>
                                <td>
                                    <?php 
                                        $statusClass = '';
                                        switch($atendimento['status']) {
                                            case 'aberto':
                                                $statusClass = 'bg-danger text-light';
                                                break;
                                            case 'em_andamento':
                                                $statusClass = 'bg-warning text-dark';
                                                break;
                                            case 'concluido':
                                                $statusClass = 'bg-success';
                                                break;
                                            default:
                                                $statusClass = 'bg-secondary';
                                                break;
                                        }
                                    ?>
                                    <span class="badge-status <?php echo $statusClass; ?>"><?php echo htmlspecialchars($atendimento['status']); ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <nav>
                <ul class="pagination justify-content-center">
                    <?php 
                        $totalPages = ceil($totalAtendimentos / $limit);
                        for($i = 1; $i <= $totalPages; $i++): 
                    ?>
                        <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
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
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>