<?php

class AtendimentoModel {
    private $conexao;

    public function __construct(PDO $pdo) {
        $this->conexao = $pdo;
    }
    
    public function atualizarAtendimento($id, $dados) {
        $sql = "UPDATE atendimentos SET aluno_id = :aluno_id, professor_id = :professor_id, data_atendimento = :data_atendimento, descricao = :descricao, status = :status, observacoes = :observacoes WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':aluno_id', $dados['aluno_id'], PDO::PARAM_INT);
        $stmt->bindValue(':professor_id', $dados['professor_id'], PDO::PARAM_INT);
        $stmt->bindValue(':data_atendimento', $dados['data_atendimento']);
        $stmt->bindValue(':descricao', $dados['descricao']);
        $stmt->bindValue(':status', $dados['status']);
        $stmt->bindValue(':observacoes', $dados['observacoes']);
        return $stmt->execute();
    }
    
    public function salvarAtendimento($dados) {
        $sql = "INSERT INTO atendimentos (aluno_id, professor_id, data_atendimento, descricao, status, observacoes) VALUES (:aluno_id, :professor_id, :data_atendimento, :descricao, :status, :observacoes)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':aluno_id', $dados['aluno_id'], PDO::PARAM_INT);
        $stmt->bindValue(':professor_id', $dados['professor_id'], PDO::PARAM_INT);
        $stmt->bindValue(':data_atendimento', $dados['data_atendimento']);
        $stmt->bindValue(':descricao', $dados['descricao']);
        $stmt->bindValue(':status', $dados['status']);
        $stmt->bindValue(':observacoes', $dados['observacoes']);
        return $stmt->execute();
    }
    
    public function excluirAtendimento($id) {
        $sql = "DELETE FROM atendimentos WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getTotalAtendimentos() {
        $sql = "SELECT COUNT(*) FROM atendimentos";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    
    public function getTotalAtendimentosAtivos() {
        $sql = "SELECT COUNT(*) FROM atendimentos WHERE status = 'ativo'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    
    public function getAtendimentosPaginados($limit, $offset) {
        $sql = "SELECT a.id, a.data_atendimento, a.descricao, al.nome AS nome_aluno, p.nome AS nome_professor, a.status 
                FROM atendimentos a
                JOIN alunos al ON a.aluno_id = al.id
                JOIN professores p ON a.professor_id = p.id
                ORDER BY a.data_atendimento DESC
                LIMIT :limit OFFSET :offset";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function listarAtendimentos() {
        $sql = "SELECT a.id, a.data_atendimento, a.descricao, al.nome AS nome_aluno, p.nome AS nome_professor, a.status 
                FROM atendimentos a
                JOIN alunos al ON a.aluno_id = al.id
                JOIN professores p ON a.professor_id = p.id
                ORDER BY a.data_atendimento DESC";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAtendimentoById($id) {
        $sql = "SELECT a.*, al.nome AS nome_aluno, p.nome AS nome_professor
                FROM atendimentos a 
                JOIN alunos al ON a.aluno_id = al.id
                JOIN professores p ON a.professor_id = p.id
                WHERE a.id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function listarAtendimentosPendentes() {
        $sql = "SELECT a.id, a.data_atendimento, a.descricao, al.nome AS nome_aluno, p.nome AS nome_professor
                FROM atendimentos a
                LEFT JOIN relatorios r ON a.id = r.atendimento_id
                JOIN alunos al ON a.aluno_id = al.id
                JOIN professores p ON a.professor_id = p.id
                WHERE r.atendimento_id IS NULL
                ORDER BY a.data_atendimento DESC";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAtendimentoComEventosById($id) {
        $sql = "SELECT a.*, al.nome AS nome_aluno, p.nome AS nome_professor, r.manifestacao, r.decisao_diretor
                FROM atendimentos a 
                JOIN alunos al ON a.aluno_id = al.id 
                JOIN professores p ON a.professor_id = p.id
                LEFT JOIN relatorios r ON a.id = r.atendimento_id
                WHERE a.id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $atendimento = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($atendimento) {
            $atendimento['eventos'] = $this->getEventosByAtendimentoId($id);
        }
        return $atendimento;
    }

    public function getEventosByAtendimentoId($atendimento_id) {
        $sql = "SELECT * FROM eventos WHERE atendimento_id = :atendimento_id ORDER BY data_evento ASC";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':atendimento_id', $atendimento_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function listarRelatoriosExistentes() {
        $sql = "SELECT a.id, a.data_atendimento, al.nome AS nome_aluno, p.nome AS nome_professor, r.data_relatorio
                FROM atendimentos a
                JOIN relatorios r ON a.id = r.atendimento_id
                JOIN alunos al ON a.aluno_id = al.id
                JOIN professores p ON a.professor_id = p.id
                ORDER BY r.data_relatorio DESC";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function atualizarCamposRelatorio($atendimento_id, $manifestacao, $decisao_diretor) {
        try {
            $sql = "SELECT id FROM relatorios WHERE atendimento_id = :atendimento_id";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':atendimento_id', $atendimento_id);
            $stmt->execute();
            $relatorio = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($relatorio) {
                $sql = "UPDATE relatorios SET manifestacao = :manifestacao, decisao_diretor = :decisao_diretor WHERE atendimento_id = :atendimento_id";
                $stmt = $this->conexao->prepare($sql);
            } else {
                $sql = "INSERT INTO relatorios (atendimento_id, manifestacao, decisao_diretor) VALUES (:atendimento_id, :manifestacao, :decisao_diretor)";
                $stmt = $this->conexao->prepare($sql);
            }

            $stmt->bindValue(':atendimento_id', $atendimento_id);
            $stmt->bindValue(':manifestacao', $manifestacao);
            $stmt->bindValue(':decisao_diretor', $decisao_diretor);

            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Erro ao atualizar ou inserir relatório: " . $e->getMessage());
            return false;
        }
    }
}