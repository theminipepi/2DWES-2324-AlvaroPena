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

        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $salario = $_POST['salario'];
        $fecha_nac = $_POST['fecha_nac'];
        $fech_ini = $_POST['fech_ini'];
        $fech_fin = $_POST['fech_fin'];
        $nombreDepartamento = $_POST['departamento'];

        // Saco el código del departamento
        $cod_dpto = $conn->prepare("SELECT cod_dpto FROM departamento WHERE nombre_dpto = $nombreDepartamento");

        //Inserto los valores a la tabla empleado
        $stmtEmpleado = $conn->prepare("INSERT INTO empleado (dni, nombre, apellidos, salario, fecha_nac) VALUES (:dni, :nombre, :apellidos, :salario, :fecha_nac)");
        $stmtEmpleado->bindParam(':dni', $dni);
        $stmtEmpleado->bindParam(':nombre', $nombre);
        $stmtEmpleado->bindParam(':apellidos', $apellidos);
        $stmtEmpleado->bindParam(':salario', $salario);
        $stmtEmpleado->bindParam(':fecha_nac', $fecha_nac);
        $stmtEmpleado->execute();

        // Insertamos los valores de la tabla de emple_depart
        $stmtEmple_Depart = $conn->prepare("INSERT INTO emple_depart (dni, cod_dpto, fech_ini, fech_fin) VALUES (:dni, :cod_dpto, :fech_ini, :fech_fin)");
        $stmtEmple_Depart->bindParam(':dni', $dni);
        $stmtEmple_Depart->bindParam(':cod_dpto', $cod_dpto);
        $stmtEmple_Depart->bindParam(':fech_ini', $fech_ini);
        $stmtEmple_Depart->bindParam(':fech_fin', $fech_fin);
        $stmtEmple_Depart->execute();

    echo "New records created successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        
        <label for="dni">DNI: 
        <input type="text" name="dni"></input>
        <br>
        <label for="nombre">Nombre: 
        <input type="text" name="nombre"></input>
        <br>
        <label for="apellidos">Apellidos:
        <input type="text" name="apellidos"></input>
        <br>
        <label for="salario">Salario:
        <input type="text" name="salario"></input>
        <br>
        <label for="fecha_nac">Fecha Nacimiento
        <input type="date" name="fecha_nac"></input>
        <br>
        <label for="fech_ini">Fecha Inicio:
        <input type="date" name="fech_ini"></input>
        <br>
        <label for="fech_fin">Fecha Fin:
        <input type="date" name="fech_fin"></input>
        <br>
        <label for="departamento">Departamento: </label>
        <select name="departamento" class="form-control">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "rootroot";
            $dbname = "webemple";
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    // Establecer el modo de error de PDO a excepción
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                    $nombre_dpto = $_POST['nombre_dpto'];
            
                    // Obtener los departamentos
                    $stmtDepartamento = $conn->prepare("SELECT nombre_dpto FROM departamento");
                    $stmtDepartamento->execute();
                    $Departamento = $stmtDepartamento->fetchAll();
            foreach($Departamento as $nombre){
                echo "<option value=".$nombre['nombre_dpto'].">".$nombre['nombre_dpto']."</option>";
            }
        ?>
        </select>
        <input type="submit" value="enviar">
        <br>
    </form>
</body>
</html>
