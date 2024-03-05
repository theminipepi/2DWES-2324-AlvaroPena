<?php
include_once '../db/conexion.php';
include_once '../model/model_movwelcome.php';
include_once '../model/model_movalquilar.php';

$Data=M_UserData();

function M_VehiculosAlquilados($Data){
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT * FROM ralquileres WHERE idcliente=:idcliente AND fecha_devolucion IS NULL");
        $stmt->bindParam(':idcliente', $Data['idcliente']);
        $stmt->execute();
        $Vehiculos=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Vehiculos;
        }
    catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
}



function M_FechaAlquiler($matricula,$Data){
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT fecha_alquiler FROM ralquileres WHERE idcliente=:idcliente AND matricula=:matricula");
        $stmt->bindParam(':idcliente', $Data['idcliente']);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->execute();
        $fecha=$stmt->fetchAll(PDO::FETCH_COLUMN);
        $fechaini=$fecha[0];
        return $fechaini;
        }
    catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
}

function M_Diferencia($hoy, $fechainicio, $Data){
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT TIMESTAMPDIFF(MINUTE, :fechainicio, :hoy) AS diferencia");
        $stmt->bindParam(':fechainicio', $fechainicio);
        $stmt->bindParam(':hoy', $hoy);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $resultado=$resultado[0];
        return $resultado;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


function insertarPago($matricula,$preciototal,$ahora){
    global $conn;
    try {
        $stmt = $conn->prepare("UPDATE ralquileres
        SET fecha_devolucion = :ahora, preciototal=:preciototal, fechahorapago=:ahora 
        WHERE matricula = :matricula");
        $stmt->bindParam(':ahora', $ahora);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':preciototal', $preciototal);
        $stmt->execute();
        $Vehiculos=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Vehiculos;
        }
    catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
}