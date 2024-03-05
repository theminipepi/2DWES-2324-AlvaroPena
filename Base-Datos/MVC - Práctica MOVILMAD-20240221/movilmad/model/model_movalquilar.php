<?php
include_once '../db/conexion.php';
include_once '../model/model_movwelcome.php';

function M_VehiculoDisp(){
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT * FROM rvehiculos WHERE disponible='S'");
        $stmt->execute();
        $Datas=$stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($Datas)){
            $valid=false;
            return $valid;
        }else{
            return $Datas;
        }
    }
    catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
}

function M_DatosCarrito($matricula){
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT * FROM rvehiculos WHERE matricula=:matricula");
        $stmt->bindParam(':matricula', $matricula);
        $stmt->execute();
        $Datos=$stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $Datos;
    }
    catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
}   
    $Data=M_UserData();
function TresVehiculosMaximo($Data){
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT COUNT(matricula) FROM ralquileres WHERE idcliente=:idcliente AND fecha_devolucion IS NULL");
        $stmt->bindParam(':idcliente', $Data['idcliente']);
        $stmt->execute();
        $cantidad=$stmt->fetchAll(PDO::FETCH_COLUMN);
        $cantidad=$cantidad[0];
        return $cantidad;
    }
    catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
}

function M_PrecioBase($matricula){
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT preciobase FROM rvehiculos WHERE matricula=:matricula");
        $stmt->bindParam(':matricula', $matricula);
        $stmt->execute();
        $preciobase=$stmt->fetchAll(PDO::FETCH_COLUMN);
        $preciobase=$preciobase[0];
        return $preciobase;
    }
    catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
}

function M_Alquilar($Data){
    global $conn;
    $carrito=$_COOKIE['carrito'];
    $carrito=unserialize($carrito);
    date_default_timezone_set('Europe/Madrid');
    $date=date('Y:m:d H:i:s');
    foreach ($carrito as $orden => $matricula) {
        try {
        $stmt = $conn->prepare("INSERT INTO ralquileres (idcliente,matricula,fecha_alquiler,fecha_devolucion,preciototal,fechahorapago)VALUES (:idcliente,:matricula,:fecha_alquiler,NULL,NULL,NULL)");
        $stmt->bindParam(':idcliente', $Data['idcliente']);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':fecha_alquiler', $date);
        $stmt->execute();
    }
    catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
    }
}

function M_VehiculoSoN($matricula,$SoN){
    global $conn;
        try {
        $stmt = $conn->prepare("UPDATE rvehiculos
        SET disponible = :disponible
        WHERE matricula = :matricula;");
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':disponible', $SoN);
        $stmt->execute();
    }
    catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
}
?>