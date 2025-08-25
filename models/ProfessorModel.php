<?php
class ProfessorModel {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getProfessores() {
        $stmt = $this->pdo->query("SELECT * FROM professores ORDER BY nome");
        return $stmt->fetchAll();
    }

    public function getTotalProfessores() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM professores");
        return $stmt->fetchColumn();
    }
}