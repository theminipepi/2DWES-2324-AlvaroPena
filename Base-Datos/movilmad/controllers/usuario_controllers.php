<?php
function limpiar($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
var_dump("He entrado en la funcion de controllers");
//Llamada al modelo -- Intermediario entre vista y modelo !!!
require_once("movlogin.php");
    $usuario = limpiar($_POST['usuario']);
    $clave = limpiar($_POST['clave']);
require_once("models/mov_models.php");
?>