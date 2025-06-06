<?php

require_once __DIR__ . "/../Model/Usuario.php";

class UsuarioController{
        public static function login(){

        if ($_SERVER["REQUEST_METHOD"] === "POST"){
            $inputUsuario = $_POST["inputUsuario"];
            $inputSenha = $_POST["inputSenha"];

            $login = Usuario::login($inputUsuario, $inputSenha);
            if($login){
                header("location: index");
            } else { ?>
                <p>Usuário ou senha incorretos.</p>
            <?php }
        }
        include __DIR__ . "/../View/login.php";

        
    }

    static function cadastrar(){
        if ($_SERVER["REQUEST_METHOD"] === "POST"){
            require_once __DIR__ . "\..\Model\Usuario.php";
            $criarUsuario = $_POST["criarUsuario"];
            $criarSenha = $_POST["criarSenha"];
            $criarNome = $_POST["criarNome"];
            $existe = Usuario::existe($criarUsuario, $criarSenha);
            if($existe){
                echo"Usuario já existente.";
            } else { 
                Usuario::adicionarUsuario($criarNome, $criarUsuario, $criarSenha);
             }


        }
        
        include __DIR__ . "/../View/cadastrar.php";

    }
}

?>