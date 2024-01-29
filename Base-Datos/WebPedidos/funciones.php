<?php
function conexion(){
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "pedidos";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Establecer el modo de error de PDO a excepción
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}
function login($conn, $usuario, $clave){
    $stmtLogin = $conn->prepare("SELECT contactLastName FROM customers WHERE customerNumber = :usuario and contactLastName = :clave");
    $stmtLogin->bindParam(':usuario', $usuario);
    $stmtLogin->bindParam(':clave', $clave);
    $comprobarLogin = $stmtLogin -> fetchAll(PDO::FETCH_COLUMN);

     if($comprobarLogin == null){
        echo "Usuario o Contraseña incorrecto";
     }else{
        session_start();
        $_SESSION['usuario']=$usuario;
        header("Location: pe_inicio.php");
     }
}
function numPedido($conn){
    $stmtNumPedido = $conn->prepare("SELECT orderNumber FROM orders ORDER BY orderNumber DESC LIMIT 1");
    $stmtNumPedido->execute();
    $numPedido = $stmtNumPedido -> fetchColumn();
    $numPedido = (int)($numPedido);
    return $numPedido;
}
function producto($conn){
    $stmtProducto = $conn->prepare("SELECT productName FROM products");
    $stmtProducto->execute();
    $stockProducto = $stmtProducto->fetchAll(PDO::FETCH_ASSOC);
    return $stockProducto;
}
function  cantidad($conn, $nombre_producto){
    $stmtStock = $conn->prepare("SELECT quantityInStock FROM products WHERE productName = :nombre_producto");
    $stmtStock->bindParam(':nombre_producto', $nombre_producto);
    $stmtStock->execute();
    $stock = $stmtStock->fetch(PDO::FETCH_COLUMN);
    return $stock;

}
function nombresLinea($conn){
    $stmtLinea = $conn->prepare("SELECT DISTINCT productLine FROM products ");
    $stmtLinea->execute();
    $linea = $stmtLinea->fetchAll(PDO::FETCH_ASSOC);
    return $linea;
}
function productosLinea($conn, $nombre_linea){
    $stmtProducto = $conn->prepare("SELECT productName, quantityInStock FROM products WHERE productLine = :nombre_producto ORDER BY quantityInStock DESC");
    $stmtProducto->bindParam(':nombre_producto', $nombre_linea);
    $stmtProducto->execute();
    $productoLinea = $stmtProducto->fetchALL(PDO::FETCH_ASSOC);
    return $productoLinea;
}
function entrefechas($conn,$fecha_ini,$fecha_fin){
    $stmtProductosfecha = $conn->prepare("SELECT products.productName, SUM(orderdetails.quantityOrdered) AS total from products, orderdetails, orders Where orders.orderNumber = orderdetails.orderNumber
                                    AND orderdetails.productCode = products.productCode
                                    AND orderDate BETWEEN :fecha_ini and :fecha_fin");
    $stmtProductosfecha->bindParam(':fecha_ini', $fecha_ini);
    $stmtProductosfecha->bindParam(':fecha_fin', $fecha_fin);
    $stmtProductosfecha->execute();
    $productoFecha = $stmtProductosfecha->fetchALL(PDO::FETCH_ASSOC);
    return $productoFecha;
}
/*function ordenes($conn,$nombre_producto){
    for ($i = 0; $i < count($nombre_producto) - 1; $i++) {
        for ($j = $i + 1; $j < count($nombre_producto); $j++) {
            if ($nombre_producto[$i]['productName'] == $nombre_producto[$j]['productName']) {
                $nombre_producto[$i]['quantityOrdered'] += $nombre_producto[$j]['quantityOrdered'];
                array_splice($nombre_producto, $j);
                $j--;
                $cont++;
            }
        }
    }
    return $nombre_producto;
}*/
?>