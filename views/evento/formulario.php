<div class="row">
    <div class="col">
        <h2 class="page-header"><?php echo $id ? 'Editar Evento' : 'Registrar Novo Evento'; ?></h2>
        
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title"><i class="bi bi-calendar-plus"></i> <?php echo $id ? 'Editar Evento' : 'Registrar Evento'; ?></h3>
            </div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($evento['id'] ?? ''); ?>">
                    <input type="hidden" name="atendimento_id" value="<?php echo htmlspecialchars($atendimento['id']); ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Atendimento</label>
                        <input type="text" class="form-control" value="Atendimento #<?php echo htmlspecialchars($atendimento['id']); ?>" disabled>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Data e Hora *</label>
                            <input type="text" class="form-control datetime-mask" name="data_evento" placeholder="dd/mm/aaaa hh:mm" value="<?php echo htmlspecialchars(formatDateTime($evento['data_evento'] ?? '')); ?>" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipo de Evento *</label>
                            <select class="form-select" name="tipo" required>
                                <option value="conversa" <?php echo (isset($evento) && $evento['tipo'] == 'conversa') ? 'selected' : ''; ?>>Conversa</option>
                                <option value="ligacao" <?php echo (isset($evento) && $evento['tipo'] == 'ligacao') ? 'selected' : ''; ?>>Ligação</option>
                                <option value="abordagem" <?php echo (isset($evento) && $evento['tipo'] == 'abordagem') ? 'selected' : ''; ?>>Abordagem</option>
                                <option value="reuniao" <?php echo (isset($evento) && $evento['tipo'] == 'reuniao') ? 'selected' : ''; ?>>Reunião</option>
                                <option value="outro" <?php echo (isset($evento) && $evento['tipo'] == 'outro') ? 'selected' : ''; ?>>Outro</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Participantes</label>
                        <input type="text" class="form-control" name="participantes" value="<?php echo htmlspecialchars($evento['participantes'] ?? ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Descrição *</label>
                        <textarea class="form-control" name="descricao" rows="5" required><?php echo htmlspecialchars($evento['descricao'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex">
                        <button type="submit" class="btn btn-primary me-md-2"><i class="bi bi-save"></i> Salvar</button>
                        <a href="eventos.php?atendimento_id=<?php echo $atendimento['id']; ?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>