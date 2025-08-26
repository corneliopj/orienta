<?php

class AtendimentoModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function listarAtendimentos()
    {
        $sql = "SELECT 
                    a.id, a.descricao, a.data_atendimento, a.status, a.observacoes,
                    al.nome as nome_aluno,
                    p.nome as nome_professor
                FROM atendimentos a
                JOIN alunos al ON a.aluno_id = al.id
                JOIN professores p ON a.professor_id = p.id
                ORDER BY a.data_atendimento DESC";
        
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function salvarAtendimento($dados)
    {
        $sql = "INSERT INTO atendimentos (aluno_id, professor_id, data_atendimento, descricao, status, observacoes) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $dados['aluno_id'],
            $dados['professor_id'],
            $dados['data_atendimento'],
            $dados['descricao'] ?? null,
            $dados['status'],
            $dados['observacoes'] ?? null
        ]);
    }
    
    public function getAtendimentoById($id)
    {
        $sql = "SELECT * FROM atendimentos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function atualizarAtendimento($id, $dados)
    {
        $sql = "UPDATE atendimentos SET aluno_id = ?, professor_id = ?, data_atendimento = ?, descricao = ?, status = ?, observacoes = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $dados['aluno_id'],
            $dados['professor_id'],
            $dados['data_atendimento'],
            $dados['descricao'] ?? null,
            $dados['status'],
            $dados['observacoes'] ?? null,
            $id
        ]);
    }
    
    public function excluirAtendimento($id)
    {
        $sql = "DELETE FROM atendimentos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getTotalAtendimentosAtivos()
    {
        $sql = "SELECT COUNT(*) FROM atendimentos WHERE status IN ('aberto', 'em_andamento')";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchColumn();
    }


     public function getAtendimentosPaginados($limit, $offset)
    {
        $sql = "SELECT 
                    a.id, a.descricao, a.data_atendimento, a.status, a.observacoes,
                    al.nome as nome_aluno,
                    p.nome as nome_professor
                FROM atendimentos a
                JOIN alunos al ON a.aluno_id = al.id
                JOIN professores p ON a.professor_id = p.id
                ORDER BY a.data_atendimento DESC
                LIMIT ? OFFSET ?";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalAtendimentos()
    {
        $sql = "SELECT COUNT(*) FROM atendimentos";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchColumn();
    }
    public function getAtendimentoComEventosById($id)
    {
        // Busca o atendimento principal
        $sqlAtendimento = "SELECT 
                            a.id, a.aluno_id, a.professor_id, a.data_atendimento, a.descricao, a.status, a.observacoes,
                            al.nome as nome_aluno,
                            p.nome as nome_professor
                           FROM atendimentos a
                           JOIN alunos al ON a.aluno_id = al.id
                           JOIN professores p ON a.professor_id = p.id
                           WHERE a.id = ?";
        
        $stmtAtendimento = $this->pdo->prepare($sqlAtendimento);
        $stmtAtendimento->execute([$id]);
        $atendimento = $stmtAtendimento->fetch(PDO::FETCH_ASSOC);

        if ($atendimento) {
            // Se o atendimento for encontrado, busca os eventos relacionados
            $sqlEventos = "SELECT * FROM eventos WHERE atendimento_id = ? ORDER BY data_evento ASC";
            $stmtEventos = $this->pdo->prepare($sqlEventos);
            $stmtEventos->execute([$id]);
            $atendimento['eventos'] = $stmtEventos->fetchAll(PDO::FETCH_ASSOC);
        }

        return $atendimento;
    }
    public function atualizarCamposRelatorio($id, $dados)
    {
        $sql = "UPDATE atendimentos SET manifestacao = ?, decisao_diretor = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $dados['manifestacao'],
            $dados['decisao_diretor'],
            $id
        ]);
    }
}