<?php
/* Inserción en tabla con sentencias preparadas - MySQL PDO */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
  include "funciones.php";

    try {
        
      $conn = conexiones();

        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $id_categoria = $_POST['id_categoria'];

        // Obtener el último nombre de categoría
        obtenerUltimaCategoria($conn);

        // Extraer el número de la última categoría y calcular el siguiente
        extraerCategoria($lastCategory);

        // Insertar la nueva categoría con el nuevo ID
        insertarProducto($conn, $nuevoIdProducto);

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