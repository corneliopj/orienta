<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2 class="page-header">Gerar Dossiê do Aluno</h2>
        <div class="card shadow">
            <div class="card-body">
                <form action="index.php" method="GET">
                    <input type="hidden" name="pagina" value="relatorio">
                    <input type="hidden" name="acao" value="dossie">
                    
                    <div class="mb-3">
                        <label for="aluno_id" class="form-label">Selecione o Aluno</label>
                        <select class="form-select" id="aluno_id" name="id" required>
                            <option value="">-- Selecione um aluno --</option>
                            <?php foreach ($alunos as $aluno): ?>
                                <option value="<?php echo $aluno['id']; ?>">
                                    <?php echo htmlspecialchars($aluno['nome']); ?> (Matrícula: <?php echo htmlspecialchars($aluno['matricula']); ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary"><i class="bi bi-file-earmark-person"></i> Gerar Dossiê</button>
                    <a href="index.php?pagina=relatorio&acao=listar" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>