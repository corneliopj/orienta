<div class="row">
    <div class="col">
        <h2 class="page-header"><?php echo $professor ? 'Editar Professor' : 'Cadastrar Novo Professor'; ?></h2>
        
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title"><i class="bi bi-person-plus"></i> <?php echo $professor ? 'Editar Professor' : 'Cadastrar Professor'; ?></h3>
            </div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($professor['id'] ?? ''); ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Nome Completo *</label>
                        <input type="text" class="form-control" name="nome" value="<?php echo htmlspecialchars($professor['nome'] ?? ''); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Disciplina</label>
                        <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($professor['disciplina'] ?? ''); ?>">
                    </div>

                    <div class="d-grid gap-2 d-md-flex">
                        <button type="submit" class="btn btn-primary me-md-2"><i class="bi bi-save"></i> Salvar</button>
                        <a href="index.php?pagina=professor&acao=listar" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>