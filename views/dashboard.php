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
    <div class="col-12">
        <div class="chart-container">
            <h5 class="mb-0">Atendimentos Recentes</h5>
            <div class="recent-list">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Aluno</th>
                                <th>Descrição</th>
                                <th>Data</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($atendimentos) && is_array($atendimentos)): ?>
                                <?php foreach ($atendimentos as $atendimento): ?>
                                    <tr>
                                        <td><?php echo $atendimento['id']; ?></td>
                                        <td><?php echo $atendimento['aluno']; ?></td>
                                        <td><?php echo $atendimento['descricao']; ?></td>
                                        <td><?php echo $atendimento['data_atendimento']; ?></td>
                                        <td>
                                            <span class="badge badge-status 
                                            <?php
                                                switch ($atendimento['status']) {
                                                    case 'concluido': echo 'bg-success'; break;
                                                    case 'em_andamento': echo 'bg-warning text-dark'; break;
                                                    default: echo 'bg-info text-white'; break;
                                                }
                                            ?>">
                                                <?php echo ucfirst(str_replace('_', ' ', $atendimento['status'])); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">Nenhum atendimento recente encontrado.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>