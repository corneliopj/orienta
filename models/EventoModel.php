<?php

class EventoModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getTotalEventos()
    {
        $sql = "SELECT COUNT(*) FROM eventos";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchColumn();
    }
    public function getEventosByAtendimentoId($atendimento_id)
    {
        $sql = "SELECT id, descricao FROM eventos WHERE atendimento_id = ? ORDER BY data_evento ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$atendimento_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // ... Código anterior (getTotalEventos e getEventosByAtendimentoId) ...

    public function listarEventos()
    {
        $sql = "SELECT id, atendimento_id, data_evento, tipo, participantes, descricao FROM eventos ORDER BY data_evento DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function salvarEvento($dados)
    {
        $sql = "INSERT INTO eventos (atendimento_id, data_evento, tipo, participantes, descricao) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $dados['atendimento_id'],
            $dados['data_evento'],
            $dados['tipo'],
            $dados['participantes'],
            $dados['descricao']
        ]);
    }

    public function getEventoById($id)
    {
        $sql = "SELECT * FROM eventos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarEvento($id, $dados)
    {
        $sql = "UPDATE eventos SET atendimento_id = ?, data_evento = ?, tipo = ?, participantes = ?, descricao = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $dados['atendimento_id'],
            $dados['data_evento'],
            $dados['tipo'],
            $dados['participantes'],
            $dados['descricao'],
            $id
        ]);
    }
    
    public function excluirEvento($id)
    {
        $sql = "DELETE FROM eventos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

}