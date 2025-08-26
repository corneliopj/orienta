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
}