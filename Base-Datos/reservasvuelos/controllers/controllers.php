<?php
var_dump($_POST);
     if (isset($_POST['salir'])) {
         
         setcookie('usuario', '', time() - 3600);
         setcookie(session_name(),'', time() - 3600, '/');
         header("Location: ../index");
 
     }
     if (isset($_POST['reservar'])) {
         header("Location: ../controllers/vreservas.php");
     }
     if (isset($_POST['consultar'])) {
        header("Location: ../controllers/vconsultas");
    }
?>