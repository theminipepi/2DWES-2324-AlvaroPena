<?php
require_once("../models/devolver_models.php");
require_once("./movdevolver_controllers.php");

var_dump($_POST['vehiculos']);
if (isset($_POST['devolver'])) {
    devolverCoche($_SESSION['idcliente'],$_POST['vehiculos']);
}
if(isset($_POST['volver'])){
    header("Location: ../views/movwelcome.php");
}
?>