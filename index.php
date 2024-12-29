<?php
session_start(); 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <title>Examen 1</title>
    </head>

    <body>
        <h1>Examen 1</h1>
        <form method = "POST">
            <label for = "row-start">Fila INICIO:</label>
            <input type = "number" name = "row-start" min = "1" max = "6">

            <label for = "column-start">Columna INICIO:</label>
            <input type = "number" name = "column-start" min = "1" max = "6">
            <br><br>
            <label for = "row-end">Fila FIN:</label>
            <input type = "number" name = "row-end" min = "1" max = "6">

            <label for = "column-end">Columna FIN:</label>
            <input type = "number" name = "column-end" min = "1" max = "6">
            <br><br>
            <input type = "submit" value = "Prueba">
            <br><br>

        </form>
        <?php
        //variables del form//
        $rowStart = $_POST["row-start"];
        $columnStart = $_POST["column-start"];
        $rowEnd = $_POST["row-end"];
        $columnEnd = $_POST["column-end"];
        
        //Arrays de los posibles colores y numeros que puede haber//
        $colors = ["Blue", "Black", "Red", "Yellow", "Green", "White"];
        $numbers = ["1", "2", "3", "4", "5", "6"];

        //Donde se guarda las combinaciones//
        $combos = []; //combinaciones posibles en un array//
        $randomGrid = [];//Array multidimensional de 6 arrays con 6 elementos casa uno//

        //Crear funcion para coger combinaciones posibles de los colores y números//
        function generarCombinaciones($colors, $numbers) {
            global $combos;
            global $randomGrid;
            if (empty($_SESSION['randomGrid'])) { //Si "session" está vacío, poner combinaciones en array//
                foreach ($colors as $color) {
                    foreach ($numbers as $number) { //Para cada color mirar cada número y poner la combinación de los dos en un array//
                        $combos[] = $number . '-' . $color;
                    }
                }
                shuffle($combos); //Crear un órden aleatorio de las combinaciones posibles//
                $randomGrid = array_chunk($combos,6); //Organizar el array "combos" en un array multidimensional, con 6 elementos cada array//
                $_SESSION['randomGrid'] = $randomGrid;
            } else {
                $randomGrid = $_SESSION['randomGrid']; //Si "session" no está vacío, usar el "randomGrid" ya creado.  Para pulsar "submit" sin cambiar el grid//
            }
        }
        generarCombinaciones($colors, $numbers);
        
        
        //Función para dibujar la tabla usando un loop//
        function dibujarTablero($randomGrid) {
            echo "<table border = 1>"; //crear tabla para que sea más legible//
            for ($i = 0; $i < count($randomGrid); $i++) {
                echo "<tr>";
                for ($j = 0; $j < count($randomGrid[$i]); $j++) {
                    echo "<td> ". $randomGrid[$i][$j] ." </td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
        dibujarTablero($randomGrid);

        //función para ver si una tirada está permitida usando los variables del form//
        //Si falta alguna entrada, si las entradas no causan cambio de posición, o si las entradas causan un movimiento que no sea vertical o horizontal, da "NO PERMITIDO"//
        function tiradaPermitida($rowStart, $columnStart, $rowEnd, $columnEnd) {
            
            if (!is_numeric($rowStart) || !is_numeric($rowEnd) || !is_numeric($columnStart) || !is_numeric($columnEnd)) {
                echo "<br>Tirada NO PERMITIDA";
            } elseif ($rowStart === $rowEnd && $columnStart === $columnEnd) {
                echo "<br>Tirada NO PERMITIDA";
            } elseif ($rowStart === $rowEnd || $columnStart === $columnEnd) {
                echo "<br>Tirada PERMITIDA<br>";
                tiradaValida($rowStart, $columnStart, $rowEnd, $columnEnd); // Llamar solo si la tirada está permitida//
            } else {
                echo "<br>Tirada NO PERMITIDA";
            }
        }
        tiradaPermitida($rowStart, $columnStart, $rowEnd, $columnEnd);

        //función para ver validez de la tirada//
        function tiradaValida($rowStart, $columnStart, $rowEnd, $columnEnd) {
            global $randomGrid;
            $start = $randomGrid[$rowStart - 1][$columnStart - 1]; //Asignar variables al array. Menos uno porque el índice empieza con 0//
            $end = $randomGrid[$rowEnd - 1][$columnEnd - 1];

            if (strpos($start, "1")!==false && strpos($end, "1")!==false) { //"strpos" encuentra substring dentro de un string//
                echo "Tirada VÁLIDA";
            } elseif (strpos($start, "2")!==false && strpos($end, "2")!==false) { //Cuando "strpos" NO encuentra el substring, da "false"//
                echo "Tirada VÁLIDA";
            } elseif (strpos($start, "3")!==false && strpos($end, "3")!==false) { 
                echo "Tirada VÁLIDA";
            } elseif (strpos($start, "4")!==false && strpos($end, "4")!==false) { 
                echo "Tirada VÁLIDA";
            } elseif (strpos($start, "5")!==false && strpos($end, "5")!==false) { 
                echo "Tirada VÁLIDA";
            } elseif(strpos($start, "6")!==false && strpos($end, "6")!==false) { 
                echo "Tirada VÁLIDA";
            } elseif (strpos($start, "Blue")!==false && strpos($end, "Blue")!==false) { 
                echo "Tirada VÁLIDA";
            } elseif(strpos($start, "Black")!==false && strpos($end, "Black")!==false) { 
                echo "Tirada VÁLIDA";
            } elseif(strpos($start, "Red")!==false && strpos($end, "Red")!==false) { 
                echo "Tirada VÁLIDA";
            } elseif(strpos($start, "Yellow")!==false && strpos($end, "Yellow")!==false) { 
                echo "Tirada VÁLIDA";
            } elseif(strpos($start, "Green")!==false && strpos($end, "Green")!==false) { 
                echo "Tirada VÁLIDA";
            } elseif(strpos($start, "White")!==false && strpos($end, "White")!==false) {
                echo "Tirada VÁLIDA";
            } else {
                echo "Tirada NO VÁLIDA";
            }
        }
        ?>
    </body>
</html>
