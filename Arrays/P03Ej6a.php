<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>
<body>  
    <?php
        $array1 = array("Bases Datos", "Entornos Desarrollo", "Programación");
        $array2=array("Sistemas Informáticos","FOL","Mecanizado");
        $array3 = array("Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces", "Inglés");
        $arrayUnido = array_reverse(array_merge($array1,$array2,$array3));
        echo "Antes de eliminar Mecanizado";
        var_dump($arrayUnido);
        $busqueda=array_search("Mecanizado",$arrayUnido);
        unset($arrayUnido[$busqueda]);
        echo "Después de Eliminar Mecanizado";
        var_dump($arrayUnido);
    ?>
</body>
</html>