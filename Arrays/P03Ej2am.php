<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1" style="width:300px; height:100px; text-align:center">
    <?php
        $aux=2;
        $fila=0;
        $columna=0;

        for($i=0;$i<3;$i++){
            echo "<tr>";
            for($j=0;$j<3;$j++){
                echo "<td>";
                $array[$i][$j]=$aux;
                $aux=$aux+2;
                echo $array[$i][$j];
                echo "</td>";
            }
            echo "</tr>";
        }
        //Suma por filas
        for($i=0;$i<3;$i++){
            $fila=0;
            
            for($j=0;$j<3;$j++){
                
                $fila=$fila+$array[$i][$j];
                
            }
            echo "<tr>";
            echo "<td>";
            echo $fila." ";
            echo "</td>";
            echo "</tr>";
        }
        //Suma por columnas;
        for($i=0;$i<3;$i++){
            $columna=0;
            
            for($j=0;$j<3;$j++){
                
                $columna=$columna+$array[$j][$i];
                
            }
                echo "<tr>";
                echo "<td>";
                echo $columna." ";
                echo "</td>";
                echo "</tr>";
        }
        
    ?>
    
</body>
</html>