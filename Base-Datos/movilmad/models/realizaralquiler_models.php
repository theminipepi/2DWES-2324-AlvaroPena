<?php
require_once("../db/db.php");
function realizarAlquiler_models($idcliente, $matricula){

    $conexion = conexion();
    date_default_timezone_set('Europe/Madrid');
    $fecha_alquiler = date("Y-m-d H:i:s");

    try {
	    $stmtInsertar = $conexion->prepare("INSERT INTO ralquileres VALUES (:idcliente, :matricula, :fecha_alquiler, null, null, null)");
        $stmtInsertar->bindParam(':idcliente', $idcliente);
        $stmtInsertar->bindParam(':matricula', $matricula);
        $stmtInsertar->bindParam(':fecha_alquiler', $fecha_alquiler);
        $stmtInsertar->execute();
        actualizarDisponibilidad($matricula);

	} catch (PDOException $ex) {
		echo "Error al iniciar sesion". $ex->getMessage();
		return null;
	}

    
}
function actualizarDisponibilidad($matricula){
    $conexion = conexion();

    try {
	    $stmtActualizar = $conexion->prepare("UPDATE rvehiculos SET disponible = 'N' WHERE matricula = :matricula");
        $stmtActualizar->bindParam(':matricula', $matricula);
        $stmtActualizar->execute();

	} catch (PDOException $ex) {
		echo "Error al iniciar sesion". $ex->getMessage();
		return null;
	}
}
?>