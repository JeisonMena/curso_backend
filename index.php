<?php

function calculadora($numero_1, $numero_2, $operacion)
{
    switch ($operacion) {
        case 'suma':
            return $numero_1 + $numero_2;
        case 'resta':
            return $numero_1 - $numero_2;
        case 'multiplicacion':
            return $numero_1 * $numero_2;
        case 'division':
            if ($numero_2 == 0) {
                return "Error: División por cero.";
            }
            return $numero_1 / $numero_2;
        default:
            return "Error: Operación no válida.";
    }

}

echo calculadora(10.4, 5, 'asd');
