<div class="row">
    <div class="col">
        <h2 class="page-header"><?php echo $id ? 'Editar Relatório' : 'Gerar Novo Relatório'; ?></h2>
        
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title"><i class="bi bi-file-earmark-text"></i> <?php echo $id ? 'Editar Relatório' : 'Gerar Relatório'; ?></h3>
            </div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($relatorio['id'] ?? ''); ?>">
                    <input type="hidden" name="atendimento_id" value="<?php echo htmlspecialchars($atendimento['id'] ?? ''); ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Atendimento</label>
                        <input type="text" class="form-control" value="Atendimento #<?php echo htmlspecialchars($atendimento['id'] ?? ''); ?> - <?php echo htmlspecialchars($aluno['nome'] ?? ''); ?>" disabled>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Data do Relatório *</label>
                        <input type="text" class="form-control date-mask" name="data_relatorio" placeholder="dd/mm/aaaa" value="<?php echo htmlspecialchars(formatDate($relatorio['data_relatorio'] ?? date('Y-m-d'))); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Status *</label>
                        <select class="form-select" name="status" required>
                            <option value="pendente" <?php echo (isset($relatorio) && $relatorio['status'] == 'pendente') ? 'selected' : ''; ?>>Pendente</option>
                            <option value="aprovado" <?php echo (isset($relatorio) && $relatorio['status'] == 'aprovado') ? 'selected' : ''; ?>>Aprovado</option>
                            <option value="rejeitado" <?php echo (isset($relatorio) && $relatorio['status'] == 'rejeitado') ? 'selected' : ''; ?>>Rejeitado</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Origem do Caso *</label>
                        <textarea class="form-control" name="origem_caso" rows="4" required><?php echo htmlspecialchars($relatorio['origem_caso'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Resumo dos Eventos *</label>
                        <textarea class="form-control" name="resumo_eventos" rows="6" required><?php echo htmlspecialchars($relatorio['resumo_eventos'] ?? $resumo_eventos_automatico ?? ''); ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Manifestação da Orientação *</label>
                        <textarea class="form-control" name="manifestacao" rows="6" required><?php echo htmlspecialchars($relatorio['manifestacao'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Decisão da Direção</label>
                        <textarea class="form-control" name="decisao_diretor" rows="4"><?php echo htmlspecialchars($relatorio['decisao_diretor'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex">
                        <button type="submit" class="btn btn-primary me-md-2"><i class="bi bi-save"></i> Salvar</button>
                        <a href="relatorios.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
                        <?php if ($id): ?>
                            <a href="relatorios.php?imprimir=<?php echo htmlspecialchars($id); ?>" class="btn btn-info" target="_blank"><i class="bi bi-printer"></i> Imprimir</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>