<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bingo</title>
</head>
<body>
<?php
    // Función para generar un cartón de bingo
    function generar_carton() {
        $carton = array();

        while (count($carton) < 15) {
            $num = rand(1, 60);
            if (!in_array($num, $carton)) {
                array_push($carton, $num);
            }
        }

        return $carton;
    }

    // Función para verificar si un jugador ha ganado
    function jugador_ha_ganado($cartones) {
        foreach ($cartones as $carton) {
            if (empty(array_diff($carton, array('X')))) {
                return true;
            }
        }
        return false;
    }

    // Inicializamos un array llamado $jugadores que contendrá los cartones de los jugadores
    $jugadores = array();

    // Generamos los cartones para los 4 jugadores, cada uno con 3 cartones
    for ($i = 1; $i <= 4; $i++) {
        $cartones_jugador = array();
        for ($j = 0; $j < 3; $j++) {
            $carton = generar_carton();
            array_push($cartones_jugador, $carton);
        }
        $jugadores["Jugador $i"] = $cartones_jugador;
    }

    // Inicializamos un array llamado $bombo que representa los números del bombo
    $bombo = array();

    // Inicializamos un contador $j y una variable $victoria para controlar el juego
    $j = 0;
    $victoria = false;

    // El juego continúa hasta que un jugador gane
    while (!$victoria) {
        // Verificamos si algún jugador ha ganado
        foreach ($jugadores as $jugador => $cartones) {
            if (jugador_ha_ganado($cartones)) {
                $victoria = true;
                echo "$jugador ha ganado";
                break;
            }
        }

        if (!$victoria) {
            // Simulamos el sorteo de un número aleatorio entre 1 y 60 y lo añadimos al bombo
            $numeroSorteado = rand(1, 60);
            if (!in_array($numeroSorteado, $bombo)) {
                array_push($bombo, $numeroSorteado);
            }

            // Verificamos si el número está en los cartones de los jugadores y lo marcamos
            foreach ($jugadores as $jugador => $cartones) {
                foreach ($cartones as $key => $carton) {
                    if (numero_en_carton($numeroSorteado, $carton)) {
                        $carton[array_search($numeroSorteado, $carton)] = 'X';
                        $jugadores[$jugador][$key] = $carton;
                    }
                }
            }

            // Incrementamos el contador del bombo para el próximo sorteo
            $j++;
        }
    }

    // Mostramos el contenido del bombo para depuración
    var_dump($bombo);
?>
</body>
</html>
