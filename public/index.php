<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title"><i class="bi bi-house-door-fill"></i> Bem-vindo ao Sistema de Acompanhamento</h3>
            </div>
            <div class="card-body">
                <p>Este sistema permite o gerenciamento de casos de acompanhamento educacional, incluindo:</p>
                <ul>
                    <li>Cadastro de alunos e professores</li>
                    <li>Registro de atendimentos iniciais</li>
                    <li>Registro de eventos de acompanhamento</li>
                    <li>Geração de relatórios finais</li>
                </ul>
                
                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <div class="card bg-light dashboard-card">
                            <div class="card-body text-center">
                                <i class="bi bi-people-fill display-4 text-primary mb-3"></i>
                                <h5>Alunos</h5>
                                <a href="alunos.php" class="btn btn-primary btn-sm mt-2">Gerenciar</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="card bg-light dashboard-card">
                            <div class="card-body text-center">
                                <i class="bi bi-journal-text display-4 text-primary mb-3"></i>
                                <h5>Atendimentos</h5>
                                <a href="atendimentos.php" class="btn btn-primary btn-sm mt-2">Gerenciar</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="card bg-light dashboard-card">
                            <div class="card-body text-center">
                                <i class="bi bi-file-earmark-text-fill display-4 text-primary mb-3"></i>
                                <h5>Relatórios</h5>
                                <a href="relatorios.php" class="btn btn-primary btn-sm mt-2">Gerenciar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>