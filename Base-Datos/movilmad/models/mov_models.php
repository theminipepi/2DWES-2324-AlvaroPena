<?php
require_once("controllers/usuario_controllers.php");
function login($usuario, $clave){
    var_dump("He entrado en la funcion de models");
    
    global $conexion;

    try {
	$stmtLogin = $conn->prepare("SELECT email FROM rclientes WHERE email = :usuario and idcliente = :clave");
    $stmtLogin->bindParam(':usuario', $usuario);
    $stmtLogin->bindParam(':clave', $clave);
    $stmtLogin->execute();
    $comprobarLogin = $stmtLogin -> fetchAll(PDO::FETCH_COLUMN);

     if($comprobarLogin == null){
        echo "Usuario o Contraseña incorrecto";
     }else{
        session_start();
        $_SESSION['usuario']=$usuario;
        header("Location: movwelcome.php");
     } 

	} catch (PDOException $ex) {
		echo "Error al iniciar sesion". $ex->getMessage();
		return null;
	}

    
}
?>