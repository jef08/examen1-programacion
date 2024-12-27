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
            <label for = "row-start">Row START:</label>
            <input type = "number" name = "row-start" min = "1" max = "6">

            <label for = "column-start">Column START:</label>
            <input type = "number" name = "column-start" min = "1" max = "6">
            <br><br>
            <label for = "row-end">Row END:</label>
            <input type = "number" name = "row-end" min = "1" max = "6">

            <label for = "column-end">Column END:</label>
            <input type = "number" name = "column-end" min = "1" max = "6">
            <br><br>
            <input type = "submit" value = "submit">

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
        //randomCombos contiene las combinaciones posibles en un array//
        //randomGrid contiene las combinaciones en un array multidimensional de 6 arrays con 6 elementos casa uno//
        $randomCombos = [];
        $randomGrid = [];

        //Crear funcion para realizar el tablero//
        //Usar "empty" para ver si "session" está vacío.  Si es asi guardamos el nuevo array, si no, usamos el array guardado en "session"//
        //Quiero mirar como producir un nuevo orden cuando recargas la página pero mantener el mismo orden cuando le das a "Submit"//
        function storeRandom($colors, $numbers) {
            global $randomCombos;
            global $randomGrid;
            if (empty($_SESSION['randomGrid'])) {
                foreach ($colors as $color) {
                    foreach ($numbers as $number) { //para cada color mirar cada número y poner la combinación de los dos en un array//
                        $randomCombos[] = $number . '-' . $color;
                    }
                }
                shuffle($randomCombos); //crear un órden aleatorio de las combinaciones posibles//
                $randomGrid = array_chunk($randomCombos,6); //Organizar el array "randomCombos" en un array multidimensional, con 6 elementos cada array//
                $_SESSION['randomGrid'] = $randomGrid;
            } else {
                $randomGrid = $_SESSION['randomGrid']; //Si ya hay sesión, usa el "randomGrid" ya creado.  Para pulsar "submit" sin cambiar el grid//
            }
        }
        storeRandom($colors, $numbers);
        
        
        //Función para dibujar el tablero usando un loop//
        function printTable($randomGrid) {
            for ($i = 0; $i < count($randomGrid); $i++) {
                echo "<br>";
                for ($j = 0; $j < count($randomGrid[$i]); $j++) {
                    echo " ". $randomGrid[$i][$j] ." ";
                }
            }
        }
        printTable($randomGrid);

        //función para ver si una tirada está permitida usando los variables del form//
        //Si falta alguna entrada, si las entradas no causan cambio de posición, o si las entradas causan un movimiento que no sea vertical o horizontal, da "NO PERMITIDO"//
        function checkMoveAllowance($rowStart, $columnStart, $rowEnd, $columnEnd) {
            
            if (!is_numeric($rowStart) || !is_numeric($rowEnd) || !is_numeric($columnStart) || !is_numeric($columnEnd)) {
                echo "<br><br>Tirada NO PERMITIDA";
            } elseif ($rowStart === $rowEnd && $columnStart === $columnEnd) {
                echo "<br><br>Tirada NO PERMITIDA";
            } elseif ($rowStart === $rowEnd || $columnStart === $columnEnd) {
                echo "<br><br>Tirada PERMITIDA<br>";
                checkMoveValidity($rowStart, $columnStart, $rowEnd, $columnEnd);
            } else {
                echo "<br><br>Tirada NO PERMITIDA";
            }
        }
        checkMoveAllowance($rowStart, $columnStart, $rowEnd, $columnEnd);

        //función para ver validez de la tirada//
        //Si 
        function checkMoveValidity($rowStart, $columnStart, $rowEnd, $columnEnd) {
            global $randomGrid;
            $start = $randomGrid[$rowStart - 1][$columnStart - 1]; //Asignar variables al array. Menos uno porque el índice empieza con 0//
            $end = $randomGrid[$rowEnd - 1][$columnEnd - 1];

            if (strpos($start, "1")!==false && strpos($end, "1")!==false) { //"strpos" encuentra substring dentro de un string//
                echo "Tirada VÁLIDA";
            } elseif (strpos($start, "2")!==false && strpos($end, "2")!==false) { 
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
