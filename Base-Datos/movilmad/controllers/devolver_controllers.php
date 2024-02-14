<?php
require_once("../models/devolver_models.php");
require_once("./movdevolver_controllers.php");
var_dump($_POST);
//var_dump($_SESSION);
var_dump($_POST['vehiculos']);
if (isset($_POST['devolver'])) {
    devolverCoche($_SESSION['idcliente'],$_POST['vehiculos']);
}
?>