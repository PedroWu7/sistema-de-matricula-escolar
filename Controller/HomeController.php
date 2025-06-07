<?php

class HomeController{

    static function index(){
        if (!isset($_SESSION["usuario"])) {
            $_SESSION["usuario"] = "Guest";
            $_SESSION["nivel_acesso"] = "visitante";
        }
        
        if(isset($_SESSION['mensagem_alerta'])){ ?>
            <script> alert('<?= $_SESSION['mensagem_alerta'] ?>') </script>
            <?php $_SESSION['mensagem_alerta'] = null; ?>
        <?php } 

        include __DIR__ . "/../View/index.php"; 
    }

    static function logout(){
        session_start();
        session_unset();
        session_destroy();
        header("location: index");  
        exit;

    }

    static function gerenciar(){
        include __DIR__ . "/../View/utilizadores.php"; 
    }
}

?>