<?php
class AtendimentoModel {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAtendimentosPaginados($limit, $offset) {
        $stmt = $this->pdo->prepare("SELECT a.id, al.nome as aluno_nome, a.descricao, a.data_atendimento, a.status FROM atendimentos a JOIN alunos al ON a.aluno_id = al.id ORDER BY a.data_atendimento DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTotalAtendimentos() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM atendimentos");
        return $stmt->fetchColumn();
    }

    public function getTotalAtendimentosAtivos() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM atendimentos WHERE status = 'aberto' OR status = 'em_andamento'");
        return $stmt->fetchColumn();
    }

    public function getTotalEventos() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM eventos");
        return $stmt->fetchColumn();
    }
}