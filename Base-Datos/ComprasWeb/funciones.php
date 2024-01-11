<?php
function conexion(){
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "comprasweb";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Establecer el modo de error de PDO a excepción
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}
function añadirCliente($conn, $nif, $nombre, $apellido, $cp, $direccion , $ciudad, $clave){
    
    $stmtCliente = $conn->prepare("INSERT INTO cliente (nif, nombre, apellido, cp, direccion, ciudad, usuario, clave) VALUES (:nif, :nombre, :apellido, :np, :direccion, :ciudad, :usuario, :clave)");
        $stmtCliente->bindParam(':nif', $nif);
        $stmtCliente->bindParam(':nombre', $nombre);
        $stmtCliente->bindParam(':apellido', $apellido);
        $stmtCliente->bindParam(':cp', $cp);
        $stmtCliente->bindParam(':direccion', $direccion);
        $stmtCliente->bindParam(':ciudad', $ciudad);
        $stmtCliente->bindParam(':usuario', $nombre);
        $stmtCliente->bindParam(':clave', $clave);
        $stmtCliente->execute();
    
}
function login($conn, $usuario, $clave){

    $stmtLogin = $conn->prepare("SELECT usuario FROM cliente WHERE usuario = :usuario and clave = :clave");
    $stmtLogin->bindParam(':usuario', $usuario);
    $stmtLogin->bindParam(':clave', $clave);
    $stmtLogin->execute();
    $comprobarLogin = $stmtLogin -> fetchAll(PDO::FETCH_COLUMN);
    
    if($comprobarLogin = null){
        echo "Usuario o Contraseña incorrecto";
    }else{
        session_start();
        $_SESSION[$usuario];
        header("Location: compras.php");
        
    }
}
?>
