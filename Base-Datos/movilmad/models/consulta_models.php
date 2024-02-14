<?php
require_once("../db/db.php");
 
function listadoVehiculos($idcliente, $fechadesde,$fechahasta){

    $conexion = conexion();

    try {
	$stmtListado = $conexion->prepare("SELECT 
    ralquileres.matricula,
    rvehiculos.marca,
    rvehiculos.modelo,
    ralquileres.fecha_alquiler,
    ralquileres.fecha_devolucion,
    ralquileres.preciototal  
FROM 
    ralquileres
JOIN 
    rvehiculos ON ralquileres.matricula = rvehiculos.matricula
WHERE 
    ralquileres.idcliente = :idcliente
    AND ralquileres.fecha_alquiler BETWEEN :fechadesde AND :fechahasta
ORDER BY 
    ralquileres.fecha_alquiler ASC;
");
    $stmtListado->bindParam(':idcliente', $idcliente);
    $stmtListado->bindParam(':fechadesde', $fechadesde);
    $stmtListado->bindParam(':fechahasta', $fechahasta);
    $stmtListado->execute();
    $vehiculos = $stmtListado -> fetchAll(PDO::FETCH_ASSOC);
    return $vehiculos;

	} catch (PDOException $ex) {
		echo "Error al iniciar sesion". $ex->getMessage();
		return null;
	}
}

?>