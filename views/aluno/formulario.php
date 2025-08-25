<div class="row">
    <div class="col">
        <h2 class="page-header"><?php echo $aluno ? 'Editar Aluno' : 'Cadastrar Novo Aluno'; ?></h2>
        
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title"><i class="bi bi-person-plus"></i> <?php echo $aluno ? 'Editar Aluno' : 'Cadastrar Aluno'; ?></h3>
            </div>
            <div class="card-body">
                <form method="POST" action="../public/index.php?pagina=aluno">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($aluno['id'] ?? ''); ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Nome Completo *</label>
                        <input type="text" class="form-control" name="nome" value="<?php echo htmlspecialchars($aluno['nome'] ?? ''); ?>" required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Matrícula</label>
                            <input type="text" class="form-control" name="matricula" value="<?php echo htmlspecialchars($aluno['matricula'] ?? ''); ?>">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Data de Nascimento</label>
                            <input type="text" class="form-control date-mask" name="data_nascimento" placeholder="dd/mm/aaaa" value="<?php echo htmlspecialchars(formatDate($aluno['data_nascimento'] ?? '')); ?>">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Turma</label>
                            <input type="text" class="form-control" name="turma" value="<?php echo htmlspecialchars($aluno['turma'] ?? ''); ?>">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Responsável</label>
                            <input type="text" class="form-control" name="responsavel" value="<?php echo htmlspecialchars($aluno['responsavel'] ?? ''); ?>">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Telefone</label>
                        <input type="text" class="form-control phone-mask" name="telefone" value="<?php echo htmlspecialchars($aluno['telefone'] ?? ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Observações</label>
                        <textarea class="form-control" name="observacoes" rows="3"><?php echo htmlspecialchars($aluno['observacoes'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex">
                        <button type="submit" class="btn btn-primary me-md-2"><i class="bi bi-save"></i> Salvar</button>
                        <a href="../public/index.php?pagina=aluno&acao=listar" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>