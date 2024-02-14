<?php
require_once("../db/db.php");
 
function sacarCoches($idcliente){

    $conexion = conexion();

    try {
	$stmtvehiculos = $conexion->prepare("SELECT matricula FROM ralquileres WHERE idcliente = :idcliente and fecha_devolucion is null");
    $stmtvehiculos->bindParam(':idcliente', $idcliente);
    $stmtvehiculos->execute();
    $vehiculos = $stmtvehiculos -> fetchAll(PDO::FETCH_ASSOC);
    return $vehiculos;

	} catch (PDOException $ex) {
		echo "Error al iniciar sesion". $ex->getMessage();
		return null;
	}
}

function precioVehiculo($matricula){
    $conexion = conexion();

    try {
	$preciovehiculo = $conexion->prepare("SELECT preciobase FROM rvehiculos WHERE matricula = :matricula");
    $preciovehiculo->bindParam(':matricula', $matricula);
    $preciovehiculo->execute();
    $precio = $preciovehiculo -> fetch(PDO::FETCH_COLUMN);
    return $precio;

	} catch (PDOException $ex) {
		echo "Error al iniciar sesion". $ex->getMessage();
		return null;
	}
}
function sacarFechaAlquiler($matricula, $idcliente){
    $conexion = conexion();
    try {
        $stmtFecha = $conexion->prepare("SELECT fecha_alquiler FROM ralquileres WHERE matricula = :matricula and idcliente = :idcliente");
        $stmtFecha->bindParam(':matricula', $matricula);
        $stmtFecha->bindParam(':idcliente', $idcliente);
        $stmtFecha->execute();
        $fecha = $stmtFecha -> fetch(PDO::FETCH_COLUMN);
        return $fecha;
    
        } catch (PDOException $ex) {
            echo "Error al iniciar sesion". $ex->getMessage();
            return null;
        }
}
function calcularPrecio($matricula,$idcliente){
    
    date_default_timezone_set('Europe/Madrid');
    $fecha_devolucion = date("Y-m-d H:i:s");
    $fecha_alquiler = sacarFechaAlquiler($matricula, $idcliente);
    $precio = precioVehiculo($matricula);

    $tiempo1 = strtotime($fecha_alquiler);
    $tiempo2 = strtotime($fecha_devolucion);

    // Calcular la diferencia en segundos
    $segundos = abs($tiempo2 - $tiempo1);

    // Convertir la diferencia a minutos
    $tiempo = $segundos / 60;

    $preciototal = $precio * $tiempo;

    return $preciototal;
}
function devolverCoche($idcliente,$matricula){

    $conexion = conexion();
    $preciototal = calcularPrecio($matricula,$idcliente);
    date_default_timezone_set('Europe/Madrid');
    $fecha_devolucion = date("Y-m-d H:i:s");

    try {
	    $stmtDevolucion = $conexion->prepare("UPDATE ralquileres SET fecha_devolucion = :fecha_devolucion, preciototal = :preciototal where matricula = :matricula and idcliente = :idcliente");
        $stmtDevolucion->bindParam(':idcliente', $idcliente);
        $stmtDevolucion->bindParam(':matricula', $matricula);
        $stmtDevolucion->bindParam(':fecha_devolucion', $fecha_devolucion);
        $stmtDevolucion->bindParam(':preciototal', $preciototal);
        $stmtDevolucion->execute();
        

	} catch (PDOException $ex) {
		echo "Error al iniciar sesion". $ex->getMessage();
		return null;
	}
}
?>