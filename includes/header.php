<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Acompanhamento Educacional</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #e83e8c;
            --primary-light: #f8d7e3;
            --primary-dark: #d81b60;
            --secondary: #6c757d;
            --success: #28a745;
            --info: #17a2b8;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
            --sidebar-width: 250px;
        }
        
        body {
            background-color: #fafafa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            z-index: 1000;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .sidebar-brand {
            padding: 1.5rem 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-brand h4 {
            margin: 0;
            font-weight: 700;
        }
        
        .sidebar-nav {
            padding: 1rem 0;
        }
        
        .sidebar .nav-item {
            margin-bottom: 0.25rem;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 0.75rem 1.5rem;
            transition: all 0.2s;
        }
        
        .sidebar .nav-link:hover, 
        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid white;
        }
        
        .sidebar .nav-link i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }
        
        /* Conteúdo Principal */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all 0.3s;
        }
        
        /* Topbar */
        .topbar {
            background-color: white;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .search-container {
            position: relative;
            width: 300px;
        }
        
        .search-container input {
            border-radius: 20px;
            padding-left: 40px;
            background-color: #f5f5f5;
            border: 1px solid #eee;
        }
        
        .search-container i {
            position: absolute;
            left: 15px;
            top: 10px;
            color: var(--secondary);
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 15px;
            color: var(--primary);
            font-weight: bold;
        }
        
        /* Cards de Estatísticas */
        .stat-card {
            border-radius: 0.5rem;
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            transition: transform 0.2s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card.primary { border-left: 4px solid var(--primary); }
        .stat-card.success { border-left: 4px solid var(--success); }
        .stat-card.info { border-left: 4px solid var(--info); }
        .stat-card.warning { border-left: 4px solid var(--warning); }
        
        .stat-icon {
            font-size: 2rem;
            color: var(--primary);
        }
        
        .stat-card.success .stat-icon { color: var(--success); }
        .stat-card.info .stat-icon { color: var(--info); }
        .stat-card.warning .stat-icon { color: var(--warning); }
        
        /* Lista de Atendimentos */
        .recent-list .list-group-item {
            border-left: 3px solid transparent;
            transition: all 0.2s;
            margin-bottom: 10px;
            border-radius: 0.5rem;
            border: 1px solid rgba(0, 0, 0, 0.08);
        }
        
        .recent-list .list-group-item:hover {
            border-left-color: var(--primary);
            background-color: #f8f9fa;
        }
        
        .badge-status {
            padding: 0.35em 0.65em;
            border-radius: 20px;
            font-size: 0.75em;
            font-weight: 500;
        }
        
        /* Gráficos */
        .chart-container {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        /* Responsividade */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                text-align: center;
            }
            
            .sidebar-brand h4, .sidebar .nav-link span {
                display: none;
            }
            
            .sidebar .nav-link i {
                margin-right: 0;
                font-size: 1.3rem;
            }
            
            .main-content {
                margin-left: 70px;
            }
            
            .search-container {
                width: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="topbar">
            <div class="search-container">
                <i class="bi bi-search"></i>
                <input type="text" class="form-control" placeholder="Pesquisar...">
            </div>
            <div class="user-info">
                <div class="notifications me-3">
                    <i class="bi bi-bell-fill text-secondary"></i>
                    <span class="badge bg-danger badge-number">3</span>
                </div>
                <div class="user-avatar">
                    RP
                </div>
            </div>
        </div>