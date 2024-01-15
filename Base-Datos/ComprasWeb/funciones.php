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
    
    $stmtCliente = $conn->prepare("INSERT INTO cliente (nif, nombre, apellido, cp, direccion, ciudad, usuario, clave) VALUES (:nif, :nombre, :apellido, :cp, :direccion, :ciudad, :usuario, :clave)");
        $stmtCliente->bindParam(':nif', $nif);
        $stmtCliente->bindParam(':nombre', $nombre);
        $stmtCliente->bindParam(':apellido', $apellido);
        $stmtCliente->bindParam(':cp', $cp);
        $stmtCliente->bindParam(':direccion', $direccion);
        $stmtCliente->bindParam(':ciudad', $ciudad);
        $stmtCliente->bindParam(':usuario', $nombre);
        $stmtCliente->bindParam(':clave', $clave);
        $stmtCliente->execute();
        echo "Cliente añadido correctamente";
    
}
function login($conn, $usuario, $clave){

    $stmtLogin = $conn->prepare("SELECT clave FROM cliente WHERE usuario = :usuario and clave = :clave");
    $stmtLogin->bindParam(':usuario', $usuario);
    $stmtLogin->bindParam(':clave', $clave);
    $stmtLogin->execute();
    $comprobarLogin = $stmtLogin -> fetchAll(PDO::FETCH_COLUMN);

     if($comprobarLogin == null){
        echo "Usuario o Contraseña incorrecto";
     }else{
        session_start();
        $_SESSION['usuario']=$usuario;
        $_SESSION['clave'] = $clave;
        header("Location: compras.php");
     }
}
function carrito(){

}
function dni($conn, $usuario, $clave){
    $stmtDni = $conn->prepare("SELECT nif FROM cliente WHERE usuario = '$usuario' and clave = '$clave'");
    $stmtDni->bindParam(':usuario', $usuario);
    $stmtDni->execute();
    $dni = $stmtDni -> fetchAll(PDO::FETCH_COLUMN);
    var_dump($dni);
    return $dni;
}
function producto($conn){
    $stmtProducto = $conn->prepare("SELECT nombre, precio, id_producto FROM producto");
    $stmtProducto->execute();
    $producto = $stmtProducto -> fetchAll(PDO::FETCH_ASSOC);
    var_dump($producto);
    return $producto;
}
function sacarNombreProducto($conn, $producto){
    $stmtNombreProducto = $conn->prepare("SELECT id_producto FROM producto WHERE nombre = '$nombre'");
    $stmtNombreProducto->execute();
    $nombreProducto = $stmtNombreProducto -> fetchAll(PDO::FETCH_ASSOC);
    var_dump($nombreProducto);
    return $productos;
}
function comprobarProducto($conn){
return false;
}

?>
