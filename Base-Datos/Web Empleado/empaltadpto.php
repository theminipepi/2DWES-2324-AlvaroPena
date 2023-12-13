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

        $nombre_dpto = $_POST['nombre_dpto'];

        // Obtener el último nombre de categoría
        $stmtLastCategory = $conn->prepare("SELECT cod_dpto FROM departamento ORDER BY cod_dpto DESC LIMIT 1");
        $stmtLastCategory->execute();
        $lastCategory = $stmtLastCategory->fetchColumn();

        // Extraer el número de la última categoría y calcular el siguiente
        $ultimoNumero = intval(substr($lastCategory, 2));
        $nuevoDepart = 'D' . str_pad($ultimoNumero + 1, 3, '0', STR_PAD_LEFT);

        // Insertar la nueva categoría con el nuevo ID
        $stmt = $conn->prepare("INSERT INTO departamento (cod_dpto, nombre_dpto) VALUES (:cod_dpto, :nombre_dpto)");
        $stmt->bindParam(':cod_dpto', $nuevoDepart);
        $stmt->bindParam(':nombre_dpto', $nombre_dpto);
        
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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        
        <label for="nombre_dpto">nombre_dpto
        <input type="text" name="nombre_dpto"></input>
        <br>
        <input type="submit" value="enviar">
        <br>
    </form>
</body>
</html>
