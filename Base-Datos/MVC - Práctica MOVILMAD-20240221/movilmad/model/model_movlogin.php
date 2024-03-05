<?php
include_once '../db/conexion.php';

function M_LoginData($email,$password){
   global $conn; 
    try {
        $stmt = $conn->prepare("SELECT nombre, apellido FROM rclientes WHERE email=:email AND idcliente=:idcliente");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':idcliente', $password);
        $stmt->execute();
        $Data=$stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($Data)){
            $valid=false;
            return $valid;
        }else{;
            $valid=true;
            return $valid;
        }
    }
    catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
}
?>