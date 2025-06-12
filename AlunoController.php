<?php
require_once __DIR__ . "/../Config/Banco.php";
require_once __DIR__ . "/../Model/Aluno.php";

class AlunoController {

    public static function listar() {
        $pdo = Banco::conn();
        $sql = "SELECT * FROM alunos";
        $result = $pdo->query($sql);
        $alunos = $result->fetch_All(PDO::FETCH_ASSOC);

        echo "<h2>Lista de Alunos</h2>";
        echo "<a href='?p=aluno-cadastrar'>Novo Aluno</a><br><br>";
        foreach ($alunos as $aluno) {
            echo "{$aluno['nome']} ({$aluno['matricula']}) - 
                  <a href='?p=aluno-editar/{$aluno['id']}'>Editar</a> | 
                  <a href='?p=aluno-excluir/{$aluno['id']}'>Excluir</a><br>";
        }
    }

    public static function cadastrar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pdo = Banco::conn();
            $sql = "INSERT INTO alunos (nome, matricula) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$_POST["nome"], $_POST["matricula"]]);
            header("Location: ?p=aluno-listar");
            exit;
        }

        echo "<h2>Cadastrar Aluno</h2>
              <form method='POST'>
                  Nome: <input name='nome'><br>
                  Matrícula: <input name='matricula'><br>
                  <button type='submit'>Salvar</button>
              </form>";
    }

    public static function editar($id) {
        $pdo = Banco::conn();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $sql = "UPDATE alunos SET nome=?, matricula=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$_POST["nome"], $_POST["matricula"], $id]);
            header("Location: ?p=aluno-listar");
            exit;
        }

        $stmt = $pdo->prepare("SELECT * FROM alunos WHERE id = ?");
        $stmt->execute([$id]);
        $aluno = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($aluno && is_array($aluno)) {
            echo "<h2>Editar Aluno</h2>
                  <form method='POST'>
                      Nome: <input name='nome' value='{$aluno["nome"]}'><br>
                      Matrícula: <input name='matricula' value='{$aluno["matricula"]}'><br>
                      <button type='submit'>Salvar</button>
                  </form>";
        } else {
            echo "<p>Aluno não encontrado.</p>";
        }
    }

    public static function excluir($id) {
        $pdo = Banco::conn();
        $sql = "DELETE FROM alunos WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        header("Location..: ?p=aluno-listar");
        exit;
    }
}
