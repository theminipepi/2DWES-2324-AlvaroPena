<?php
require_once("../db/db.php");
function login($usuario, $clave){

    $conexion = conexion();

    try {
	$stmtLogin = $conexion->prepare("SELECT nombre, apellido, idcliente FROM rclientes WHERE email = :usuario and idcliente = :clave and fecha_baja is null and pendiente_pago = 0 ");
    $stmtLogin->bindParam(':usuario', $usuario);
    $stmtLogin->bindParam(':clave', $clave);
    $stmtLogin->execute();
    $comprobarLogin = $stmtLogin -> fetch(PDO::FETCH_ASSOC);
    var_dump($comprobarLogin);
     if($comprobarLogin == null){
        return null;
        }else{
            return $comprobarLogin;
        }

	} catch (PDOException $ex) {
		echo "Error al iniciar sesion". $ex->getMessage();
		return null;
	}

    
}
?>