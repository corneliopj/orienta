<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2 class="page-header"><?php echo isset($evento) ? 'Editar Evento' : 'Novo Evento'; ?></h2>

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title"><i class="bi bi-calendar-event"></i> Formulário de Evento</h3>
            </div>
            <div class="card-body">
                <form action="index.php?pagina=evento" method="POST">
                    <input type="hidden" name="id" value="<?php echo $evento['id'] ?? ''; ?>">
                    
                    <div class="mb-3">
                        <label for="atendimento_id" class="form-label">ID do Atendimento</label>
                        <input type="number" class="form-control" id="atendimento_id" name="atendimento_id" value="<?php echo $evento['atendimento_id'] ?? $_GET['atendimento_id'] ?? ''; ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="data_evento" class="form-label">Data e Hora do Evento</label>
                        <input type="datetime-local" class="form-control" id="data_evento" name="data_evento" value="<?php echo $evento['data_evento'] ?? ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo de Evento</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo $evento['tipo'] ?? ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="participantes" class="form-label">Participantes</label>
                        <input type="text" class="form-control" id="participantes" name="participantes" value="<?php echo $evento['participantes'] ?? ''; ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="4"><?php echo $evento['descricao'] ?? ''; ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Salvar Evento</button>
                    <a href="index.php?pagina=evento&acao=listar" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>