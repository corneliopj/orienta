<?php
class RelatorioModel {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getRelatorios() {
        $stmt = $this->pdo->query("SELECT r.id, r.origem_caso, r.data_relatorio, a.nome as aluno_nome, r.status FROM relatorios r JOIN atendimentos at ON r.atendimento_id = at.id JOIN alunos a ON at.aluno_id = a.id ORDER BY r.data_relatorio DESC");
        return $stmt->fetchAll();
    }

    public function getTotalRelatoriosPendentes() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM relatorios WHERE status != 'concluido'");
        return $stmt->fetchColumn();
    }
}