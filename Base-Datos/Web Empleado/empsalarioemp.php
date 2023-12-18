<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        
        <label for="empleado">Empleado: </label>
        <select name="empleado" class="form-control">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "rootroot";
            $dbname = "webemple";
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    // Establecer el modo de error de PDO a excepción
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                    $nombre = $_POST['nombre'];
            
                    // Obtener los departamentos
                    $stmtEmpleado = $conn->prepare("SELECT nombre FROM empleado");
                    $stmtEmpleado->execute();
                    $empleado = $stmtEmpleado->fetchAll();
            foreach($empleado as $nombre){
                echo "<option value=".$nombre['nombre'].">".$nombre['nombre']."</option>";
            }
        ?>
        </select>
        <br><br>
        <label for="porcentaje">Porcentaje: 
        <input type="number" name="porcentaje"></input>
        <br>
        <br>
        <input type="radio" name="porcentaje" value="suma"> Sumar<br>
        <input type="radio" name="porcentaje" value="resta"> Restar<br>
        <br><br>
        <input type="submit" value="enviar">
        <br>
    </form>
</body>
</html>
<?php
/*Inserción en tabla Prepared Statement- mysql PDO*/
if ($_SERVER['REQUEST_METHOD']=='POST') {
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "webemple";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Establecer el modo de error de PDO a excepción
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $nombre = $_POST['empleado'];
        $porcentaje = $_POST['porcentaje'];
        
        // Obtenemos el salario del empleado
        $stmtsalario = $conn->prepare("SELECT salario From empleado Where nombre = '$nombre'");
        $stmtsalario->execute();
        $salario = $stmtsalario->fetchAll();
        var_dump($salario);
        
        // Calculamos el nuevo salario
        if(!(empty($_POST['suma']))){
            $suma = $_POST['suma'];
            $salario = $salario + ($salario * ($porcentaje/100));
        }
        if(!(empty($_POST['resta']))){
            $resta = $_POST['resta'];
            $salario = $salario - ($salario * ($porcentaje/100));
        }    
        
        // Actualizamos el nuevo salario
        $salarioActualizado = $conn->prepare("UPDATE empleado set salario = '$salario'");
        $salarioActualizado->execute();

    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
}
?>

