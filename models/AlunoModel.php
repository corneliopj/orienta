<?php
class AlunoModel {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAlunos() {
        $stmt = $this->pdo->query("SELECT * FROM alunos ORDER BY nome");
        return $stmt->fetchAll();
    }
    public function listarAlunos()
    {
        $sql = "SELECT id, nome FROM alunos ORDER BY nome ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    public function getAlunoById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM alunos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function getTotalAlunos() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM alunos");
        return $stmt->fetchColumn();
    }

    public function salvarAluno($dados) {
        $id = $dados['id'] ?? null;
        $nome = $dados['nome'];
        $matricula = $dados['matricula'];
        $data_nascimento = !empty($dados['data_nascimento']) ? date('Y-m-d', strtotime(str_replace('/', '-', $dados['data_nascimento']))) : null;
        $turma = $dados['turma'];
        $responsavel = $dados['responsavel'];
        $telefone = $dados['telefone'];
        $observacoes = $dados['observacoes'];
        
        if ($id) {
            $stmt = $this->pdo->prepare("UPDATE alunos SET nome = ?, matricula = ?, data_nascimento = ?, turma = ?, responsavel = ?, telefone = ?, observacoes = ? WHERE id = ?");
            $stmt->execute([$nome, $matricula, $data_nascimento, $turma, $responsavel, $telefone, $observacoes, $id]);
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO alunos (nome, matricula, data_nascimento, turma, responsavel, telefone, observacoes) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nome, $matricula, $data_nascimento, $turma, $responsavel, $telefone, $observacoes]);
        }
    }

    public function excluirAluno($id) {
        $stmt = $this->pdo->prepare("DELETE FROM alunos WHERE id = ?");
        $stmt->execute([$id]);
    }
}