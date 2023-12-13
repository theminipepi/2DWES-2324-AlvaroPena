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
        $precio = $_POST['precio'];
        $id_categoria = $_POST['id_categoria'];

        // Obtener el último nombre de categoría
        $stmtLastCategory = $conn->prepare("SELECT id_producto FROM producto ORDER BY id_producto DESC LIMIT 1");
        $stmtLastCategory->execute();
        $lastCategory = $stmtLastCategory->fetchColumn();//Devuelve una sola columna de la siguiente fila de un conjunto de resultados



        // Extraer el número de la última categoría y calcular el siguiente
        $ultimoNumero = intval(substr($lastCategory, 2));//Obtiene el valor entero de una variable
        $nuevoIdProducto = 'P' . str_pad($ultimoNumero + 1, 3, '0', STR_PAD_LEFT);

        echo $nuevoIdProducto;

        // Insertar la nueva categoría con el nuevo ID
        $stmt = $conn->prepare("INSERT INTO producto (nombre, id_producto, precio, id_categoria) VALUES (:nombre, :id_producto, :precio, :id_categoria)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':id_producto', $nuevoIdProducto);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':id_categoria', $id_categoria);
        $stmt->execute();

        echo "Producto añadido correctamente.";

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

  <h2>Dar de Alta a una Productos</h2>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="nombre">Nombre Producto: </label>
    <input type="text" id="nombre" name="nombre" required>
    <br>
    <label for="precio">Precio: </label>
    <input type="text" id="precio" name="precio" required>
    <br>
    <label for="id_categoria">ID Categoria: </label>
    <input type="text" id="id_categoria" name="id_categoria" required>
    <br>
    <button type="submit">Enviar</button>
    <button type="reset">Borrar</button>
  </form>
</body>
</html>