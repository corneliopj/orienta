<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Acompanhamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #4e73df;
            --secondary: #858796;
            --success: #1cc88a;
            --info: #36b9cc;
            --warning: #f6c23e;
            --danger: #e74a3b;
            --light: #f8f9fc;
            --dark: #5a5c69;
        }
        
        body {
            background-color: #f8f9fc;
        }
        
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--primary) 10%, #224abe 100%);
            color: white;
            position: fixed;
            z-index: 100;
        }
        
        .sidebar .nav-item {
            margin-bottom: 0.25rem;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 1rem;
        }
        
        .sidebar .nav-link:hover {
            color: white;
        }
        
        .sidebar .nav-link.active {
            font-weight: bold;
            color: white;
            background: rgba(255, 255, 255, 0.1);
            border-left: 4px solid white;
        }
        
        .sidebar .nav-link i {
            margin-right: 0.5rem;
        }
        
        .topbar {
            height: 4.375rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            background: white;
        }
        
        .card-dashboard {
            border-left: 4px solid;
            border-radius: 0.35rem;
        }
        
        .card-dashboard.primary { border-left-color: var(--primary); }
        .card-dashboard.success { border-left-color: var(--success); }
        .card-dashboard.info { border-left-color: var(--info); }
        .card-dashboard.warning { border-left-color: var(--warning); }
        
        .card-dashboard .text-xs {
            font-size: 0.7rem;
        }
        
        .content {
            margin-left: 224px;
            padding: 1.5rem;
            width: calc(100% - 224px);
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                min-height: auto;
            }
            
            .content {
                margin-left: 0;
                width: 100%;
            }
        }
        
        .progress-sm {
            height: 0.5rem;
        }
        
        .recent-item {
            border-left: 3px solid transparent;
            transition: all 0.2s;
        }
        
        .recent-item:hover {
            border-left-color: var(--primary);
            background-color: #f8f9fc;
        }
        
        .badge-status {
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 400;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar col-md-3 col-lg-2 p-0">
            <div class="p-4">
                <h4 class="text-center mb-4">Orientação Educacional</h4>
                <hr class="my-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">
                            <i class="bi bi-speedometer2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="alunos.php">
                            <i class="bi bi-people-fill"></i>Alunos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="professores.php">
                            <i class="bi bi-person-badge"></i>Professores
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="atendimentos.php">
                            <i class="bi bi-journal-text"></i>Atendimentos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="eventos.php">
                            <i class="bi bi-calendar-event"></i>Eventos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="relatorios.php">
                            <i class="bi bi-file-earmark-text"></i>Relatórios
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Conteúdo -->
        <div class="content">
            <!-- Topbar -->
            <nav class="navbar mb-4 topbar">
                <div class="container-fluid">
                    <button class="btn btn-link d-md-none" type="button">
                        <i class="bi bi-list"></i>
                    </button>
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-bell-fill"></i>
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-envelope-fill"></i>
                                <span class="badge badge-danger badge-counter">1</span>
                            </a>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Raquel Petersen Rosa</span>
                                <img class="img-profile rounded-circle" width="32" height="32" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwYXRoIGQ9Ik0yMCAydjRhMiAyIDAgMCAxLTIgMmEyIDIgMCAwIDAgMiAydjRhMiAyIDAgMCAxLTIgMkg0YTIgMiAwIDAgMS0yLTJ2LTJjMS4wIDAgMi0uOSAyLTJWMmEyIDIgMCAwIDEgMi0yaDEyYTIgMiAwIDAgMSAyIDJ6Ij48L3BhdGg+PHBhdGggZD0iTTggMTJoOCI+PC9wYXRoPjxwYXRoIGQ9Ik04IDE2aDgiPjwvcGF0aD48L3N2Zz4=">
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Conteúdo do Dashboard -->
            <div class="container-fluid">
                <!-- Estatísticas -->
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card card-dashboard primary h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total de Alunos</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">4</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card card-dashboard success h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Atendimentos Ativos</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-journal-text fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card card-dashboard info h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Eventos Registrados</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-calendar-event fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card card-dashboard warning h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Relatórios Pendentes</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-file-earmark-text fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gráficos e Conteúdo -->
                <div class="row">
                    <!-- Gráfico de Status de Atendimentos -->
                    <div class="col-xl-8 col-lg-7">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Status dos Atendimentos</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-bar">
                                    <canvas id="statusChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gráfico de Turmas -->
                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Alunos por Turma</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-pie pt-4 pb-2">
                                    <canvas id="turmaChart" width="400" height="260"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Atendimentos Recentes -->
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Atendimentos Recentes</h6>
                                <a href="atendimentos.php" class="btn btn-sm btn-primary">Ver Todos</a>
                            </div>
                            <div class="card-body">
                                <div class="list-group">
                                    <div class="list-group-item recent-item p-3">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">FERNANDO SOUZA COSTA</h6>
                                            <small class="text-muted">22/08/2025</small>
                                        </div>
                                        <p class="mb-1">Envolvimento em consumo de bebida inadequada na escola.</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">6° A</small>
                                            <span class="badge badge-status bg-warning text-dark">Em Andamento</span>
                                        </div>
                                    </div>
                                    <div class="list-group-item recent-item p-3">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">JENNYFER VITÓRIA ABREU SANTOS</h6>
                                            <small class="text-muted">22/08/2025</small>
                                        </div>
                                        <p class="mb-1">Trouxe mistura inadequada em garrafa de água.</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">6° A</small>
                                            <span class="badge badge-status bg-warning text-dark">Em Andamento</span>
                                        </div>
                                    </div>
                                    <div class="list-group-item recent-item p-3">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">JHONATAN HENRYQUE SOUZA SILVA</h6>
                                            <small class="text-muted">22/08/2025</small>
                                        </div>
                                        <p class="mb-1">Envolvimento em consumo de bebida inadequada.</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">6° A</small>
                                            <span class="badge badge-status bg-success">Concluído</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Gráfico de Status de Atendimentos
        var ctx = document.getElementById('statusChart').getContext('2d');
        var statusChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Abertos', 'Em Andamento', 'Concluídos'],
                datasets: [{
                    label: 'Quantidade',
                    data: [0, 3, 1],
                    backgroundColor: [
                        '#4e73df',
                        '#f6c23e',
                        '#1cc88a'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Gráfico de Turmas
        var ctx2 = document.getElementById('turmaChart').getContext('2d');
        var turmaChart = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['6° A'],
                datasets: [{
                    data: [4],
                    backgroundColor: ['#4e73df'],
                    hoverBackgroundColor: ['#2e59d9'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>
</html>