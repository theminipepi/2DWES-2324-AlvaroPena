<?php
require_once("../db/db.php");
 
function sacarCoches($idcliente){

    $conexion = conexion();

    try {
	$stmtvehiculos = $conexion->prepare("SELECT matricula FROM ralquileres WHERE idcliente = :idcliente");
    $stmtvehiculos->bindParam(':idcliente', $idcliente);
    $stmtvehiculos->execute();
    $vehiculos = $stmtvehiculos -> fetchAll(PDO::FETCH_ASSOC);
    return $vehiculos;

	} catch (PDOException $ex) {
		echo "Error al iniciar sesion". $ex->getMessage();
		return null;
	}
}


?>