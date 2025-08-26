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
        // Seleciona apenas as colunas existentes na tabela 'professores'
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

    // Salvar um novo professor
    public function salvarProfessor($dados)
    {
        $sql = "INSERT INTO professores (nome, email, telefone, observacoes) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $dados['nome'],
            $dados['email'],
            $dados['telefone'],
            $dados['observacoes']
        ]);
    }

    // Atualizar um professor existente
    public function atualizarProfessor($id, $dados)
    {
        $sql = "UPDATE professores SET nome = ?, email = ?, telefone = ?, observacoes = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $dados['nome'],
            $dados['email'],
            $dados['telefone'],
            $dados['observacoes'],
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