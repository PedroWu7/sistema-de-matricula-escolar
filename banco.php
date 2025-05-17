<?php
    $conn = new mysqli("localhost", "root", "", "sistema_escolar", "3306");
    if($conn->error){ ?>
        <p>Erro ao fazer a conexão com o banco.</p>
    <?php }

    function usuarioExiste($conn, $usuario){
        $q = "SELECT * FROM alunos WHERE usuario = '$usuario'";
        $resultado = $conn->query($q);
        if ($resultado->num_rows > 0){
            $aluno = $resultado->fetch_assoc();
            $_SESSION["id"] = $aluno["id"];
            $_SESSION["nome"] = $aluno["nome"];
            $_SESSION["usuario"] = $aluno["usuario"];
            $_SESSION["senha"] = $aluno["senha"];
            $_SESSION["nivel_acesso"] = $aluno["nivel_acesso"];
            $_SESSION["cursos_matriculados"] = $aluno["cursos_matriculados"];
            return true;
        }
        return false;
    }

    function adicionarUsuario($conn, $nome ,$usuario, $senha){
        $sql = "INSERT INTO alunos (id, nome, usuario, senha, nivel_acesso, cursos_matriculados) VALUES (NULL, '$nome', '$usuario', '$senha', 'aluno', NULL)";
        $resp = $conn->query($sql);
    }

    function listarCursos(){
        return [
                    [
                        "nome"=>"Curso de PHP", "imagem"=>"https://www.cursoemvideo.com/wp-content/uploads/2019/08/php.jpg", "descricao"=>"Curso muito bom de PHP"
                    ],
                    [
                        "nome"=>"Curso de C#", "imagem"=>"https://i.ytimg.com/vi/oTivhgjbhIg/maxresdefault.jpg", "descricao"=>"Curso topzeira de C#"
                    ]
               ];
    }
?>