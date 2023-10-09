<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1" style="width:300px;height:100px;text-align:center">
    <?php

        //Mostrar por filas
        $aux=2;
        for($i=0;$i<5;$i++){
            echo "<tr>";
            for($j=0;$j<3;$j++){
                echo "<td>";
                $filas[$i][$j]=$aux;
                echo $filas[$i][$j];
                $aux = $aux + 2;
                echo "</td>";
            }
            echo "</tr>";
        }
    ?>
    </table>
    <br><br><br>
    <table>
    <?php
    for($i=0;$i<5;$i++){
            for($j=0;$j<3;$j++){
                echo "(".$i.",".$j.") = ".$filas[$i][$j]."<br>";
            }
    }
    echo "<br><br>";
    for($i=0;$i<3;$i++){
        for($j=0;$j<5;$j++){
            echo "(".$j.",".$i.") = ".$filas[$j][$i]."<br>";
        }
}
    ?>
    </table>
</body>
</html>