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

    ?>
    </tabla>
</body>
</html>