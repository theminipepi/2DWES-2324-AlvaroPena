<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        
    <?php
    $array1 = array("Bases Datos", "Entornos Desarrollo", "Programación");
    $array2=array("Sistemas Informáticos","FOL","Mecanizado");
    $array3 = array("Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces", "Inglés");
    $arrayUnir1 = [];
    //Introducir valores al array sin función mediante un foreach
    foreach($array1 as $x){
        $arrayUnir1[].=$x;
    }
    foreach($array2 as $x){
        $arrayUnir1[].=$x;
    }
    foreach($array3 as $x){
        $arrayUnir1[].=$x;
    }
    echo "Array Sin Funciones";
    var_dump($arrayUnir1);
    //Concatener los arrays mediante la función merge
    $conc=array_merge($array1, $array2, $array3);
    echo "Array con Array_merge";
    var_dump($conc);
    //Concatener los arrays mediante el push
    $arrayPush = [];
    array_push($arrayPush,$array1,$array2,$array3);
    echo "Array con la función Array_Push()";
    var_dump($arrayPush);
    ?>
</body>
</html>