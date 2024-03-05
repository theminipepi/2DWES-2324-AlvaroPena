<?php
include_once '../db/conexion.php';


function M_UserData(){
    global $conn;
    $email = $_COOKIE['usuario'];
    try {
        $stmt = $conn->prepare("SELECT nombre, apellido, idcliente FROM rclientes WHERE email=:email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $Data=$stmt->fetch(PDO::FETCH_ASSOC);
        
        return $Data;
        }
    
    catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
}
?>