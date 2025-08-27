<div class="row">
    <div class="col">
        <h2 class="page-header"><?php echo isset($atendimento) ? 'Editar Atendimento' : 'Cadastrar Novo Atendimento'; ?></h2>
        
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title"><i class="bi bi-journal-plus"></i> <?php echo isset($atendimento) ? 'Editar Atendimento' : 'Cadastrar Atendimento'; ?></h3>
            </div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($atendimento['id'] ?? ''); ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Aluno *</label>
                        <select class="form-select" name="aluno_id" required>
                            <option value="">Selecione um aluno...</option>
                            <?php foreach ($alunos as $aluno): ?>
                                <option value="<?php echo $aluno['id']; ?>" <?php echo (isset($atendimento) && $atendimento['aluno_id'] == $aluno['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($aluno['nome']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Professor *</label>
                        <select class="form-select" name="professor_id" required>
                            <option value="">Selecione um professor...</option>
                            <?php foreach ($professores as $professor): ?>
                                <option value="<?php echo $professor['id']; ?>" <?php echo (isset($atendimento) && $atendimento['professor_id'] == $professor['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($professor['nome']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
    <label for="data_atendimento" class="form-label">Data do Atendimento</label>
    <div class="input-group">
        <?php
        $data_formatada = null;
        if (isset($atendimento['data_atendimento'])) {
            $data_formatada = date('d/m/Y', strtotime($atendimento['data_atendimento']));
        }
        ?>
        <input type="date" class="form-control" id="data_atendimento" name="data_atendimento" value="<?php echo htmlspecialchars($atendimento['data_atendimento'] ?? ''); ?>" required>
        <?php if ($data_formatada): ?>
            <span class="input-group-text"><?php echo $data_formatada; ?></span>
        <?php endif; ?>
    </div>
</div>
                    
                    <div class="mb-3">
                        <label class="form-label">Descrição *</label>
                        <textarea class="form-control" name="descricao" rows="3" required><?php echo htmlspecialchars($atendimento['descricao'] ?? ''); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status *</label>
                        <select class="form-select" name="status" required>
                            <option value="aberto" <?php echo (isset($atendimento) && $atendimento['status'] == 'aberto') ? 'selected' : ''; ?>>Aberto</option>
                            <option value="em_andamento" <?php echo (isset($atendimento) && $atendimento['status'] == 'em_andamento') ? 'selected' : ''; ?>>Em Andamento</option>
                            <option value="concluido" <?php echo (isset($atendimento) && $atendimento['status'] == 'concluido') ? 'selected' : ''; ?>>Concluído</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Observações</label>
                        <textarea class="form-control" name="observacoes" rows="3"><?php echo htmlspecialchars($atendimento['observacoes'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex">
                        <button type="submit" class="btn btn-primary me-md-2"><i class="bi bi-save"></i> Salvar</button>
                        <a href="index.php?pagina=atendimento&acao=listar" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>