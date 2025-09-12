<?php
class ProfessorModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Listar todos os professores
    public function listarProfessores()
    {
        // Seleciona apenas as colunas nome e disciplina da tabela
        $sql = "SELECT id, nome, disciplina FROM professores ORDER BY nome";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obter um professor por ID
    public function getProfessorById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM professores WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Salvar um novo professor com nome e disciplina
    public function salvarProfessor($dados)
    {
        $sql = "INSERT INTO professores (nome, disciplina) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $dados['nome'],
            $dados['disciplina']
        ]);
    }

    // Atualizar um professor existente com nome e disciplina
    public function atualizarProfessor($id, $dados)
    {
        $sql = "UPDATE professores SET nome = ?, disciplina = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $dados['nome'],
            $dados['disciplina'],
            $id
        ]);
    }

    // Excluir um professor
    public function excluirProfessor($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM professores WHERE id = ?");
        return $stmt->execute([$id]);
    }
}