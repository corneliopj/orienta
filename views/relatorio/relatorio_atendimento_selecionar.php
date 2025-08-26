<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2 class="page-header">Gerar Relatório de Atendimento</h2>
        <div class="card shadow">
            <div class="card-body">
                <form action="index.php" method="GET">
                    <input type="hidden" name="pagina" value="relatorio">
                    <input type="hidden" name="acao" value="atendimento">
                    
                    <div class="mb-3">
                        <label for="atendimento_id" class="form-label">Selecione o Atendimento</label>
                        <select class="form-select" id="atendimento_id" name="id" required>
                            <option value="">-- Selecione um atendimento --</option>
                            <?php foreach ($atendimentos as $atendimento): ?>
                                <option value="<?php echo $atendimento['id']; ?>">
                                    ID: <?php echo $atendimento['id']; ?> - Aluno: <?php echo htmlspecialchars($atendimento['nome_aluno']); ?> - Data: <?php echo formatarData($atendimento['data_atendimento']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Gerar Relatório</button>
                    <a href="index.php?pagina=relatorio&acao=listar" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>