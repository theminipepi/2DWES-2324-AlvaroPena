<HTML>
<HEAD><TITLE>EJ2-Direccion Red – Broadcast y Rango</TITLE></HEAD><body><form method="post">    <table border="1" style="width:900px; border-collapse: collapse; text-align:center;">        <tr>
            <th colspan="1">Partidos</th>
            <th colspan="8">Resultados</th>
        </tr>        <?php
        $equipos = [
            "Barcelona", "Sevilla", "R.Madrid", "Cadiz", "At.Madrid",
            "Villareal", "Eibar", "Granada", "Espanyol", "Rayo Vall",
            "Celta", "Depor", "Valencia", "Getafe",
            "Betis", "Real Sociedad", "Levante", "Osasuna", "Mallorca",
            "Alaves", "Valladolid", "Elche", "Huesca", "Lugo",
            "Sporting Gijon", "Tenerife", "Malaga", "Las Palmas"
        ];        shuffle($equipos);
        $partidos = array ();        for ($i = 0; $i < count($equipos); $i += 2) {
            $partidos[] = $equipos[$i]." vs ".$equipos[$i + 1];
        }        echo "<tr>";
        echo "<th></th>";        $tamaño = 8;        for($i = 1; $i < $tamaño+1; $i++) {
            echo "<td rowspan >Apuesta $i</td>";
        }        echo "</tr>";        $quiniela = array();        $x = array("x", 1, 2);        if(isset($_POST['enviar'])) {
            echo "<tr><th>Partidos</th><th colspan='8'>Elecciones</th></tr>";            $error = false; // Variable para rastrear errores en la selección.            for($j = 0; $j < 14; $j++) {
                echo "<tr>";
                echo "<td>".$partidos[$j]."</td>";
                for($i = 0; $i < 8; $i++) {
                    $eleccion = isset($_POST['apuesta_' . $j . '_' . $i]) ? $_POST['apuesta_' . $j . '_' . $i] : "";
                    echo "<td>".$eleccion."</td>";                    // Si no se ha seleccionado ninguna opción, establece $error en true.
                    if (empty($eleccion)) {
                        $error = true;
                    }
                }
                echo "</tr>";
            }            if ($error) {
                echo "<tr><td colspan='9'><font color='red'>¡Por favor, seleccione una opción en cada apuesta!</font></td></tr>";
            }
        } else {
            for($j = 0; $j < 14; $j++) {
                echo "<tr>";
                echo "<td>".$partidos[$j]."</td>";
                for($i = 0; $i < 8; $i++) {
                    echo '<td>
                        <input type="radio" name="apuesta_' . $j . '_' . $i . '" value="x">x
                        <input type="radio" name="apuesta_' . $j . '_' . $i . '" value="1">1
                        <input type="radio" name="apuesta_' . $j . '_' . $i . '" value="2">2';
                }
                echo "</tr>";
            }
            echo "<tr><td colspan='9'><input type='submit' name='enviar' value='Enviar'></td></tr>";
        }
        ?>
    </table>
</form></body></HTML>