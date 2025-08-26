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
        $sql = "SELECT id, titulo, descricao FROM eventos WHERE atendimento_id = ? ORDER BY data_evento ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$atendimento_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}