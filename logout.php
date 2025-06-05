<?php
    session_start();
    session_unset();
    session_destroy();
    header("location: /sistema-de-matricula-escolar/View/index.php");  
    exit;
?>