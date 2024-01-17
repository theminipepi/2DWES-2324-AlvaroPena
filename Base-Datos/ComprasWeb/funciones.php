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

function login($conn,$usuario,$clave){

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
        header("Location: compras.php");
     }
}

function dni($conn,$usuario,$clave){
    $stmtDni = $conn->prepare("SELECT nif FROM cliente WHERE usuario = '$usuario' and clave = '$clave'");
    $stmtDni->bindParam(':usuario', $usuario);
    $stmtDni->execute();
    $dni = $stmtDni -> fetchAll(PDO::FETCH_COLUMN);
    return $dni;
}

function producto($conn){
    $stmtProducto = $conn->prepare("SELECT nombre, precio, id_producto FROM producto");
    $stmtProducto->execute();
    $producto = $stmtProducto -> fetchAll(PDO::FETCH_ASSOC);
    return $producto;
}

function sacarNombreProducto($conn,$producto){
    $stmtNombreProducto = $conn->prepare("SELECT id_producto FROM producto WHERE nombre = '$nombre'");
    $stmtNombreProducto->execute();
    $nombreProducto = $stmtNombreProducto -> fetchAll(PDO::FETCH_ASSOC);
    return $productos;
}

function anadirObjetoCarro($producto, $cantidad) {
    if (!isset($_SESSION['carro'][$producto])) {
        $_SESSION['carro'][$producto] = array();
    }
    $_SESSION['carro'][$producto][] = $cantidad;
}

function cerrarSession(){
    setcookie('usuario', '', time() - 3600);
    setcookie(session_name(),'', time() - 3600, '/');
    header("Location: comlogincli.php");
}

function comprobarProducto($conn, $id_producto, $cantidad) {
    $stmtcantidadProducto = $conn->prepare("SELECT cantidad FROM almacena WHERE id_producto = :id_producto");
    $stmtcantidadProducto->bindParam(':id_producto', $id_producto);
    $stmtcantidadProducto->execute();
    $cantidadProducto = $stmtcantidadProducto->fetchColumn();

    if ($cantidadProducto >= $cantidad) {
        $cantidadnueva = $cantidadProducto - $cantidad;
        $stmtActualizarCantidadProducto = $conn->prepare("UPDATE almacena SET cantidad = :cantidadnueva WHERE id_producto = :id_producto");
        $stmtActualizarCantidadProducto->bindParam(':cantidadnueva', $cantidadnueva);
        $stmtActualizarCantidadProducto->bindParam(':id_producto', $id_producto);
        $stmtActualizarCantidadProducto->execute();
    }
}
function sacarNif($conn, $usuario){
    $stmtNif = $conn->prepare("SELECT nif FROM cliente WHERE usuario = :usuario");
    $stmtNif->bindParam(':usuario', $usuario);
    $stmtNif->execute();
    $nif = $stmtNif -> fetchAll(PDO::FETCH_COLUMN);
    return $nif[0];
}

function comprar($conn,$nif,$id_producto,$fecha_compra,$cantidad){
    $stmtCompra = $conn->prepare("INSERT INTO compra (nif, id_producto, fecha_compra, unidades) VALUES(:nif,:id_producto,:fecha_compra,:cantidad)");
    $stmtCompra->bindParam(':nif', $nif);
    $stmtCompra->bindParam(':id_producto', $id_producto);
    $stmtCompra->bindParam(':fecha_compra', $fecha_compra);
    $stmtCompra->bindParam(':cantidad', $cantidad);
    $stmtCompra->execute();
    echo "Gracias por su compra";
}

function verCompras($conn, $fechaIni, $fechaFin){
    $stmtCompras = $conn->prepare("SELECT nif, id_producto, fecha_compra, unidades FROM compra WHERE fecha_compra BETWEEN :fechaIni AND :fechaFin");
    $stmtCompras->bindParam(':fechaIni', $fechaIni);
    $stmtCompras->bindParam(':fechaFin', $fechaFin);
    $stmtCompras->execute();
    $compras = $stmtCompras->fetchAll(PDO::FETCH_ASSOC);
    return $compras;
}
?>
