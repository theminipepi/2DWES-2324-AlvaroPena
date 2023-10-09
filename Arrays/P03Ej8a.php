<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
</head>
<body>  
    <?php
    $nota['Alvaro'] = "10";
    $nota['Gonzalo'] = "4";
    $nota['Izan'] = "9";
    $nota['Marcos'] = "2";
    $nota['Andres'] = "5";

    $maxNota = max($nota);
    $notaMaxNombre = array_search($maxNota, $nota);
    echo "La nota más alta es de: ".$notaMaxNombre." con una nota de: ".$maxNota."<br><br>";

    $minNota = min($nota);
    $notaMinNombre = array_search($minNota, $nota);
    echo "La nota más alta es de: ".$notaMinNombre." con una nota de: ".$minNota."<br><br>";

    $media = array_sum($nota) / count($nota);
    echo "La media de las notas es de: ".$media;
    
    ?>
</body>
</html>