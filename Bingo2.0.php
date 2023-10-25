<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bingo</title>
</head>
<body>
<?php
    // Creamos el cartón del jugador 1 y lo llenamos
    $jugador1 = array();

    // Llenamos el cartón con 15 números aleatorios entre 1 y 60
    while (count($jugador1)<15) {
        $num=rand(1,60);
        if(!(in_array($num,$jugador1))){
            array_push($jugador1,$num);
        }  
    }

    // Mostramos el contenido del cartón del jugador 1 para depuración
    var_dump($jugador1);

    // Inicializamos un array llamado $bombo que representa los números del bombo
    $bombo = array();

    // Inicializamos un contador $j y una variable $victoria para controlar el juego
    $j = 0;
    $victoria = false;

    // El juego continúa hasta que el jugador gane (cuando su cartón esté vacío)
    while (!$victoria) {
        // Verificamos si el cartón del jugador 1 está vacío
        if (count($jugador1) == 0) {
            $victoria = true;
            echo "El jugador 1 ha ganado";
        } else {
            // Simulamos el sorteo de un número aleatorio entre 1 y 60 y lo añadimos al bombo
            $numeroSorteado = rand(1, 60);
            if(!(in_array($numeroSorteado,$bombo))){
                array_push($bombo,$numeroSorteado);
            }  
            
            // Recorremos el cartón del jugador 1
            foreach ($jugador1 as $key => $numeroCarton) {
                // Comparamos cada número en el cartón con el número sorteado
                if ($numeroCarton == $numeroSorteado) {
                    // Si hay una coincidencia, eliminamos ese número del cartón
                    unset($jugador1[$key]);
                }
            }

            // Incrementamos el contador del bombo para el próximo sorteo
            $j++;
        }
    }
    var_dump($bombo);
    function NumRepetido($jugador1,$num){
        for($j=0;$j<count($jugador1);$j++){
            
        }
    }
?>
</body>
</html>
