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
        <br>
        <label for="nombre_dpto">nombre_dpto
        <input type="text" name="nombre_dpto"></input>
        <br>
        <input type="submit" value="enivar">
        <br>
    </form>
    
<?php
/*Inserción en tabla Prepared Statement- mysql PDO*/
if ($_SERVER['REQUEST_METHOD']=='POST') {
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleados1n";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO departamento (cod_dpto, nombre_dpto) VALUES (:cod_dpto, :nombre_dpto)");

    $stmt->bindParam(':cod_dpto', $cod_dpto);
    $stmt->bindParam(':nombre_dpto', $nombre_dpto);
  
    // insert a row
	$cod_dpto = $_POST['cod_dpto'];
    $nombre_dpto = $_POST['nombre_dpto'];
    $stmt->execute();

    echo "New records created successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
}
?>
</body>
</html>
