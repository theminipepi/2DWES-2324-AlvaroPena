<?php
require_once("../db/db.php");
 
function vehiculos(){

    $conexion = conexion();

    try {
	$stmtvehiculos = $conexion->prepare("SELECT matricula, marca, modelo FROM rvehiculos WHERE disponible = 'S'");
    $stmtvehiculos->execute();
    $vehiculos = $stmtvehiculos -> fetchAll(PDO::FETCH_ASSOC);
    return $vehiculos;

	} catch (PDOException $ex) {
		echo "Error al iniciar sesion". $ex->getMessage();
		return null;
	}
}

?>