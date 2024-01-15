<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form name='cdpto' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="container ">
            <fieldset>
                Reponer Producto<br><br>
                <B>Elige Producto: </B>
                <?php
                    include "funciones.php";
                    try {
                        $conn = conexiones();
                        
                        $stmt = $conn->prepare("SELECT ID_PRODUCTO, NOMBRE  FROM PRODUCTO");
                        $stmt->execute();
                        $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);
                        echo "<select name='codigo_prod' id='codigo_prod'>";
                        foreach($resultado as $llave){
                            $value=$llave['ID_PRODUCTO'];
                            $guardarnombre=$llave['NOMBRE'];
                                    echo '<option value ='.$value.'>'.$guardarnombre.'<br>';
                        }
                        echo "</select><br><br>";
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                ?>
                <B>Cantidad: </B><input type='text' name='Cantidad' value='' size=25><br><br>
                <B>Elige Almacen: </B>
                <?php
                    /*SELECTs - mysql PDO*/
                    include "funciones.php";
                    try {
                        $conn = conexiones();
                        $stmt = $conn->prepare("SELECT NUM_ALMACEN,LOCALIDAD  FROM ALMACEN");
                        $stmt->execute();
                        $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);
                        echo "<select name='localidad' id='localidad'>";
                        foreach($resultado as $llave){
                            $value=$llave['NUM_ALMACEN'];
                            $guardarnombre=$llave['LOCALIDAD'];
                                    echo '<option value ='.$value.'>'.$guardarnombre.'<br>';
                        }
                        echo "</select><br><br>";
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                ?>
            </fieldset>
            <input type="submit" value="Submit" name="crear">
        </div>
    </form>
    <?php
    function limpiar($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
        /*Inserción en tabla Prepared Statement- mysql PDO*/
        if($_SERVER["REQUEST_METHOD"]=="POST"){
        $codigo_prod=limpiar($_POST['codigo_prod']);
        $Cantidad=limpiar($_POST['Cantidad']);
        $localidad=limpiar($_POST['localidad']);
        if(empty($Cantidad)||!is_numeric($Cantidad)){
            echo "Introduce una cantidad";
        }else{
        try {
            $servername = "localhost";
            $username = "root";
            $password = "rootroot";
            $dbname = "COMPRASWEB";
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // prepare sql and bind parameters for the first query
            $stmt1 = $conn->prepare("INSERT INTO ALMACENA (NUM_ALMACEN,ID_PRODUCTO,CANTIDAD) VALUES (:NUM_ALMACEN,:ID_PRODUCTO,:CANTIDAD)");
            $stmt1->bindParam(':NUM_ALMACEN', $localidad);
            $stmt1->bindParam(':ID_PRODUCTO', $codigo_prod);
            $stmt1->bindParam(':CANTIDAD', $Cantidad);
            $stmt1->execute();
            echo "Valido";
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        }
    }
?>
</body>
</html>