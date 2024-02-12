<?php
require_once("../db/db.php");
function login($usuario, $clave){

    $conexion = conexion();

    try {
	$stmtLogin = $conexion->prepare("SELECT email FROM rclientes WHERE email = :usuario and idcliente = :clave and fecha_baja is null and pendiente_pago = 0 ");
    $stmtLogin->bindParam(':usuario', $usuario);
    $stmtLogin->bindParam(':clave', $clave);
    $stmtLogin->execute();
    $comprobarLogin = $stmtLogin -> fetchAll(PDO::FETCH_COLUMN);

     if($comprobarLogin == null){
        
        header("Location: ../movlogin.php");
        
        }else{
        session_start();
        $_SESSION['usuario']=$usuario;
        header("Location: ../views/movwelcome.php");
     } 

	} catch (PDOException $ex) {
		echo "Error al iniciar sesion". $ex->getMessage();
		return null;
	}

    
}
?>