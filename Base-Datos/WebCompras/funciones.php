.<?php
function conexiones(){
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "comprasweb";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}
function  nuevAlmacen($conn, $localidad){
    $stmt=$conn->prepare("SELECT num_almacen FROM almacen ORDER BY num_almacen DESC LIMIT 1");
    $stmt->execute();
    $ultmioAlmacen=$stmt->fetchColumn();
    $nuevoAlmacen=$ultmioAlmacen+1;
    echo $nuevoAlmacen;

    $stmt2=$conn->prepare("INSERT INTO almacen (num_almacen, localidad) VALUES (:num_almacen, :localidad)");
    $stmt2->bindParam(':num_almacen', $nuevoAlmacen);
    $stmt2->bindParam(':localidad', $localidad);
    $stmt2->execute();
    
    echo "Almacen añadido correctamente.";
}
function obtenerUltimaCategoria($conn){
    $stmtLastCategory = $conn->prepare("SELECT id_categoria FROM categoria ORDER BY id_categoria DESC LIMIT 1");
    $stmtLastCategory->execute();
    $lastCategory = $stmtLastCategory->fetchColumn();
    return $lastCategory
}
function extraerNumero($lastCategory){
    $ultimoNumero = intval(substr($lastCategory, 2));
    $nuevoIdCategoria = 'C-' . str_pad($ultimoNumero + 1, 3, '0', STR_PAD_LEFT);
    return $nuevoIdCategoria;
}
function nuevaCategoria( $conn,$nuevoIdCategoria){
    $stmt = $conn->prepare("INSERT INTO categoria (nombre, id_categoria) VALUES (:nombre, :id_categoria)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':id_categoria', $nuevoIdCategoria);
        $stmt->execute();

        echo "Categoría añadida correctamente.";
}
function extraerCategoria($lastCategory){
    $ultimoNumero = intval(substr($lastCategory, 2));//Obtiene el valor entero de una variable
    $nuevoIdProducto = 'P' . str_pad($ultimoNumero + 1, 3, '0', STR_PAD_LEFT);
    return $nuevoIdProducto;
}
function insertarProducto($conn, $nuevoIdProducto){
    $stmt = $conn->prepare("INSERT INTO producto (nombre, id_producto, precio, id_categoria) VALUES (:nombre, :id_producto, :precio, :id_categoria)");
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':id_producto', $nuevoIdProducto);
    $stmt->bindParam(':precio', $precio);
    $stmt->bindParam(':id_categoria', $id_categoria);
    $stmt->execute();

    echo "Producto añadido correctamente.";
}
?>