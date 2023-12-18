<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']);?>" method="POST">
    
    </br>
        
    </br>
        
    </br>
        
        <label for="cod_dpto">cod_dpto
        <input type="text" name="cod_dpto"></input>
        <input type="submit" value="enviar">
        <br>
    </form>
<?php
/*SELECTs - mysql PDO*/
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "empleadosnn";
    
    $cod_dpto = $_POST['cod_dpto'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT empleado.dni,empleado.nombre_emple, empleado.salario, empleado.fecha_nac  
                            FROM emple_dpto,empleado 
                            where '$cod_dpto' = emple_dpto.cod_dpto and emple_dpto.dni = empleado.dni");
                        
    $stmt->execute();

    // set the resulting array to associative
     $stmt->setFetchMode(PDO::FETCH_ASSOC);
	 $resultado=$stmt->fetchAll();
     echo "<br><br><br>";
     echo "<table border=1 style='text-align: center'>";
	 foreach($resultado as $row) {
        echo "<tr><td colspan=4 >Datos del Usuario</td></tr>";
        echo "<tr><td>DNI</td><td>Nombre Empleado</td><td>Salario</td><td>Fecha Nacimiento</td></tr>";
        echo "<tr><td>"."$row[dni]</td>"."<td> $row[nombre_emple]</td>"."<td> $row[salario]</td>"."<td> $row[fecha_nac]</td></tr>";
     }
     echo "</table>";
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
}
?>
