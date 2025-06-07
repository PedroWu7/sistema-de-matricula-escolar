<?php

require_once __DIR__ . "/../Model/Usuario.php";
session_start();

class UsuarioController{
    static function login(){

        if ($_SERVER["REQUEST_METHOD"] === "POST"){
            $inputUsuario = $_POST["inputUsuario"];
            $inputSenha = $_POST["inputSenha"];

            $login = Usuario::login($inputUsuario, $inputSenha);
            if($login){
                $_SESSION["id"] = $login["id"];
                $_SESSION["nome"] = $login["nome"];
                $_SESSION["usuario"] = $login["usuario"];
                $_SESSION["nivel_acesso"] = $login["nivel_acesso"];
                $_SESSION["cursos_matriculados"] = $login["cursos_matriculados"];
                header("location: index");
            } else { ?>
                <p>Usuário ou senha incorretos.</p>
            <?php }
        }
        include __DIR__ . "/../View/login.html";

        
    }

    static function cadastrar(){
        if ($_SERVER["REQUEST_METHOD"] === "POST"){
            $criarUsuario = $_POST["criarUsuario"];
            $criarSenha = $_POST["criarSenha"];
            $criarNome = $_POST["criarNome"];
            $existe = Usuario::existe($criarUsuario, $criarSenha);
            if($existe){ ?>
                <p>Usuário ou senha incorretos.</p>
            <?php } else { 
                Usuario::adicionar($criarNome, $criarUsuario, $criarSenha);
             }


        }
        
        include __DIR__ . "/../View/cadastrar.html";

    }
}

?>