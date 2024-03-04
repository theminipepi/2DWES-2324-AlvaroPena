<?php
require_once("../db/db.php");
function sacarVuelos(){

    $conexion = conexion();

    try {
	$stmtVuelos = $conexion->prepare("SELECT id_vuelo, origen, destino, fechahorasalida, fechahorallegada, precio_asiento FROM vuelos WHERE asientos_disponibles > 0");
    $stmtVuelos->execute();
    $vuelos = $stmtVuelos -> fetchAll(PDO::FETCH_ASSOC);
    return $vuelos;

	} catch (PDOException $ex) {
		echo "Error al iniciar sesion". $ex->getMessage();
		return null;
	}

    
}
function sacarVueloSegunId($id_vuelo){

    $conexion = conexion();

    try {
	$stmtVuelo = $conexion->prepare("SELECT origen, destino, fechahorasalida, fechahorallegada, precio_asiento FROM vuelos WHERE id_vuelo = :id_vuelo");
    $stmtVuelo->bindParam(':id_vuelo', $id_vuelo);
    $stmtVuelo->execute();
    $vuelo = $stmtVuelo -> fetchAll(PDO::FETCH_ASSOC);
    return $vuelo;

	} catch (PDOException $ex) {
		echo "Error al iniciar sesion". $ex->getMessage();
		return null;
	}

    
}
function sacarUltimaReserva(){
    $conexion = conexion();

    try {
	$stmtreserva = $conexion->prepare("SELECT id_reserva FROM reservas order by id_reserva DESC LIMIT 1");
    $stmtreserva->execute();
    $ultimaReserva = $stmtreserva -> fetch(PDO::FETCH_ASSOC);
    return $ultimaReserva['id_reserva'];

	} catch (PDOException $ex) {
		echo "Error al iniciar sesion". $ex->getMessage();
		return null;
	}
}
function sacarPrecioAsiento($id_vuelo){
    $conexion = conexion();

    try {
	$stmtprecio = $conexion->prepare("SELECT precio_asiento FROM vuelos WHERE id_vuelo = :id_vuelo");
    $stmtprecio->bindParam(':id_vuelo', $id_vuelo);
    $stmtprecio->execute();
    $precio = $stmtprecio -> fetch(PDO::FETCH_ASSOC);
    return $precio;

	} catch (PDOException $ex) {
		echo "Error al iniciar sesion". $ex->getMessage();
		return null;
	}
}
function realizarCompra($id_vuelo,$dni_pasajero,$num_asientos){
    $conexion = conexion();
    $ultimaReserva = sacarUltimaReserva();
    $parteAlfabetica = substr($ultimaReserva, 0, 1);
    $parteNumerica = intval(substr($ultimaReserva, 1));

    // Incrementar la parte numérica
    $nuevaParteNumerica = $parteNumerica + 1;

    // Formatear la nueva identificación
    $nuevoId = $parteAlfabetica . sprintf('%04d', $nuevaParteNumerica);

    date_default_timezone_set('Europe/Madrid');
    $fecha_reserva = date("Y-m-d H:i:s");

    $precio = sacarPrecioAsiento($id_vuelo);
    $preciototal = $precio['precio_asiento']*$num_asientos;
    try {
        $stmtInsertar = $conexion->prepare("INSERT INTO reservas VALUES (:id_reserva, :id_vuelo, :dni_pasajero, :fecha_reserva, :num_asientos, :preciototal)");
        $stmtInsertar->bindParam(':id_reserva', $nuevoId);
        $stmtInsertar->bindParam(':id_vuelo', $id_vuelo);
        $stmtInsertar->bindParam(':dni_pasajero', $dni_pasajero);
        $stmtInsertar->bindParam(':fecha_reserva', $fecha_reserva);
        $stmtInsertar->bindParam(':num_asientos', $num_asientos);
        $stmtInsertar->bindParam(':preciototal', $preciototal);
        $stmtInsertar->execute();
        modificarAsientos($num_asientos,$id_vuelo);
	} catch (PDOException $ex) {
		echo "Error al iniciar sesion". $ex->getMessage();
		return null;
	}

}
function asientosDisponibles($id_vuelo){
    $conexion = conexion();
    try {
    $stmtAsientos = $conexion->prepare("SELECT asientos_disponibles FROM vuelos WHERE id_vuelo = :id_vuelo");
    $stmtAsientos->bindParam(':id_vuelo', $id_vuelo);
    $stmtAsientos->execute();
    $asiento = $stmtAsientos -> fetch(PDO::FETCH_COLUMN);
    return $asiento;
} catch (PDOException $ex) {
    echo "Error al iniciar sesion". $ex->getMessage();
    return null;
}
}
function modificarAsientos($num_asientos,$id_vuelo){
    $conexion = conexion();
    $asientosDisponibles = asientosDisponibles($id_vuelo);
    $asientosActualizados = $asientosDisponibles - $num_asientos;
    
    try {
    $stmtActualizar = $conexion->prepare("UPDATE vuelos SET asientos_disponibles = :num_asientos  WHERE id_vuelo = :id_vuelo");
    $stmtActualizar->bindParam(':num_asientos', $asientosActualizados);
    $stmtActualizar->bindParam(':id_vuelo', $id_vuelo);
    $stmtActualizar->execute();
} catch (PDOException $ex) {
    echo "Error al iniciar sesion". $ex->getMessage();
    return null;
}
}
?>