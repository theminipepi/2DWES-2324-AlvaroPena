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
        $aux2=0;$max=-INF;
        for($i=0;$i<5;$i++){
            echo "<tr>";
            for($j=0;$j<3;$j++){
                echo "<td>";
                $filas[$i][$j]=rand(-10,10);
                echo $filas[$i][$j];
                echo "</td>";
            }
            echo "</tr>";
        }
        foreach($filas as $array){
                $aux2=max($array);
                if($aux2>$max){
                    $max=$aux2;
                }
        }
        echo array_search($max,array_column($filas,$array));
        

    ?>
    </table>
</body>
</html>