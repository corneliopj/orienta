

<div class="sidebar no-print">
    <div class="sidebar-brand">
       <a href="index.php" class="d-flex flex-column align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
    <img src="/../public/img/logo.png" alt="Logo Orienta" class="mb-2" style="max-height: 150px;">
  
</a>
        
    </div>
    <div class="sidebar-nav">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="index.php?pagina=dashboard">
                    <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?pagina=aluno&acao=listar">
                    <i class="bi bi-people-fill"></i> <span>Alunos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?pagina=professor&acao=listar">
                    <i class="bi bi-person-badge"></i> <span>Professores</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?pagina=atendimento&acao=listar">
                    <i class="bi bi-journal-text"></i> <span>Atendimentos</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?pagina=relatorio&acao=listar">
                    <i class="bi bi-file-earmark-text"></i> <span>Relatórios</span>
                </a>
            </li>
           
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-box-arrow-right"></i> <span>Sair</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="main-content">
    <div class="topbar nav justify-content-center .bg-success.bg-gradient no-print">
        <div id="dailyVersesWrapper"></div>
        <script async defer src="https://dailyverses.net/get/random.js?language=arc"></script>
    </div>

    <div class="container-fluid">