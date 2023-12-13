<?php
/* Inserción en tabla con sentencias preparadas - MySQL PDO */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "comprasweb";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Establecer el modo de error de PDO a excepción
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $nombre = $_POST['nombre'];

        // Obtener el último nombre de categoría
        $stmtLastCategory = $conn->prepare("SELECT id_categoria FROM categoria ORDER BY id_categoria DESC LIMIT 1");
        $stmtLastCategory->execute();
        $lastCategory = $stmtLastCategory->fetchColumn();

        // Extraer el número de la última categoría y calcular el siguiente
        $ultimoNumero = intval(substr($lastCategory, 2));
        $nuevoIdCategoria = 'C-' . str_pad($ultimoNumero + 1, 3, '0', STR_PAD_LEFT);

        // Insertar la nueva categoría con el nuevo ID
        $stmt = $conn->prepare("INSERT INTO categoria (nombre, id_categoria) VALUES (:nombre, :id_categoria)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':id_categoria', $nuevoIdCategoria);
        $stmt->execute();

        echo "Categoría añadida correctamente.";

    } catch (PDOException $e) {
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
  <title>Alta Categoria</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input, button {
      margin-bottom: 16px;
    }
  </style>
</head>
<body>

  <h2>Dar de Alta a una Categoria</h2>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="nombre">Nombre Categoria: </label>
    <input type="text" id="nombre" name="nombre" required>
    <br>
    <button type="submit">Enviar</button>
    <button type="reset">Borrar</button>
  </form>
</body>
</html>