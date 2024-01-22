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
?>