<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
</head>
<body>  
    <?php
    $edad['Alvaro'] = "22";
    $edad['Gonzalo'] = "32";
    $edad['Izan'] = "16";
    $edad['Marcos'] = "80";
    $edad['Andres'] = "120";

    foreach($edad as $i=>$x){
        echo "La edad de ".$i." es: ".$x."<br>";
    }

    $aux = next($edad);
    echo "El puntero apuntando a la segunda posición es: ",$aux."<br>";
    $aux = next($edad);
    echo "Al avanzar una posición el valor es: ",$aux."<br>";
    $aux = end($edad);
    echo "El valor de la última posición es: ",$aux."<br><br><br>";
    asort($edad);
    foreach($edad as $i=>$x){
        echo "La edad de ".$i." es: ".$x."<br>";
    }
    $aux = reset($edad);
    echo "<br>";
    echo "El primer valor del array es: ".$aux."<br>";
    $aux = end($edad);
    echo "El último valor del array es: ".$aux."<br>";
    ?>
</body>
</html>