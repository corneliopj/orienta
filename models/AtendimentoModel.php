<?php
class AtendimentoModel {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

public function getTotalAtendimentos()
    {
        $sql = "SELECT COUNT(*) FROM atendimentos";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getAtendimentosPaginados($limit, $offset)
    {
        $sql = "
            SELECT 
                a.id, 
                al.nome AS aluno, 
                a.descricao, 
                a.data_atendimento, 
                a.status
            FROM 
                atendimentos a
            JOIN 
                alunos al ON a.aluno_id = al.id
            ORDER BY 
                a.data_atendimento DESC 
            LIMIT :limit OFFSET :offset
        ";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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