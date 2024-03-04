<?php
require_once("../db/db.php");
function login($usuario, $clave){

    $conexion = conexion();

    try {
	$stmtLogin = $conexion->prepare("SELECT email, nombre, apellidos, dni FROM pasajero WHERE dni = :usuario");
    $stmtLogin->bindParam(':usuario', $usuario);
    $stmtLogin->execute();
    $comprobarLogin = $stmtLogin -> fetch(PDO::FETCH_ASSOC);
    $cuatroDigitos = substr($comprobarLogin['dni'], 4,-1);
     if($comprobarLogin == null){
        return null;
        }else{
            if($clave == $cuatroDigitos){
                return $comprobarLogin;
            }else{
                return null;
            }
        }

	} catch (PDOException $ex) {
		echo "Error al iniciar sesion". $ex->getMessage();
		return null;
	}

    
}
?>