<?php
/* Inserción en tabla con sentencias preparadas - MySQL PDO */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
  include "funciones.php";

    try {
        
        $localidad=$_POST['localidad'];
        $conn = conexiones();
        nuevoAlmacen($conn, $localidad);

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

  <h2>Dar de Alta a Almacenes</h2>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="localidad">Lugar del Almacen: </label>
    <select required name="localidad" class="form-control">
    <option value="">Elige localidad</option>
    <option value="Álava/Araba">Álava/Araba</option>
    <option value="Albacete">Albacete</option>
    <option value="Alicante">Alicante</option>
    <option value="Almería">Almería</option>
    <option value="Asturias">Asturias</option>
    <option value="Ávila">Ávila</option>
    <option value="Badajoz">Badajoz</option>
    <option value="Baleares">Baleares</option>
    <option value="Barcelona">Barcelona</option>
    <option value="Burgos">Burgos</option>
    <option value="Cáceres">Cáceres</option>
    <option value="Cádiz">Cádiz</option>
    <option value="Cantabria">Cantabria</option>
    <option value="Castellón">Castellón</option>
    <option value="Ceuta">Ceuta</option>
    <option value="Ciudad Real">Ciudad Real</option>
    <option value="Córdoba">Córdoba</option>
    <option value="Cuenca">Cuenca</option>
    <option value="Gerona/Girona">Gerona/Girona</option>
    <option value="Granada">Granada</option>
    <option value="Guadalajara">Guadalajara</option>
    <option value="Guipúzcoa/Gipuzkoa">Guipúzcoa/Gipuzkoa</option>
    <option value="Huelva">Huelva</option>
    <option value="Huesca">Huesca</option>
    <option value="Jaén">Jaén</option>
    <option value="La Coruña/A Coruña">La Coruña/A Coruña</option>
    <option value="La Rioja">La Rioja</option>
    <option value="Las Palmas">Las Palmas</option>
    <option value="León">León</option>
    <option value="Lérida/Lleida">Lérida/Lleida</option>
    <option value="Lugo">Lugo</option>
    <option value="Madrid">Madrid</option>
    <option value="Málaga">Málaga</option>
    <option value="Melilla">Melilla</option>
    <option value="Murcia">Murcia</option>
    <option value="Navarra">Navarra</option>
    <option value="Orense/Ourense">Orense/Ourense</option>
    <option value="Palencia">Palencia</option>
    <option value="Pontevedra">Pontevedra</option>
    <option value="Salamanca">Salamanca</option>
    <option value="Segovia">Segovia</option>
    <option value="Sevilla">Sevilla</option>
    <option value="Soria">Soria</option>
    <option value="Tarragona">Tarragona</option>
    <option value="Tenerife">Tenerife</option>
    <option value="Teruel">Teruel</option>
    <option value="Toledo">Toledo</option>
    <option value="Valencia">Valencia</option>
    <option value="Valladolid">Valladolid</option>
    <option value="Vizcaya/Bizkaia">Vizcaya/Bizkaia</option>
    <option value="Zamora">Zamora</option>
    <option value="Zaragoza">Zaragoza</option>
  </select>
    <br>
    <button type="submit">Enviar</button>
    <button type="reset">Borrar</button>
  </form>
</body>
</html>