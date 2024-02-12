<?php
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }
   var_dump($_POST);
    if (isset($_POST['agregar'])) {
        $_SESSION['carrito'] = $_POST['vehiculos'];
    }
    var_dump($_SESSION['carrito']);
    
?>