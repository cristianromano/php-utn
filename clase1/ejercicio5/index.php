<?php

/*Realizar un programa que en base al valor numérico de una variable $num, pueda mostrarse
por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números
entre el 20 y el 60.
Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”. */

$num = 56;
(string)$num;

switch (substr($num, 0, 1)) {
    case '2':
        if (substr($num, -1, 1) == '0') {
            echo "veinte";
        } else {            
            echo "veinti";
            unoAlNueve($num);
        }
        break;
    case '3':
        if (substr($num, -1, 1) == '0') {
            echo "treinta";
        } else {            
            echo "treinti";
            unoAlNueve($num);
        }
        break;
    case '4':
        if (substr($num, -1, 1) == '0') {
            echo "cuarenta";
        } else {            
            echo "cuarenti";
            unoAlNueve($num);
        }
        break;
    case '5':
        if (substr($num, -1, 1) == '0') {
            echo "cincuenta";
        } else {            
            echo "cincuenti";
            unoAlNueve($num);
        }
        break;
    case '6':
        if (substr($num, -1, 1) == '0') {
            echo "sesenta";
        } else {            
            echo "sesenti";
            unoAlNueve($num);
        }

    default:
        "probar con un numero de 20 a 60";
        break;
}

function unoAlNueve($abc)
{
    switch (substr($abc, -1, 1)) {
        case '1':
            echo "uno";
            break;
        case '2':
            echo "dos";
            break;
        case '3':
            echo "tres";
            break;
        case '4':
            echo "cuatro";
            break;
        case '5':
            echo "cinco";
            break;
        case '6':
            echo "seis";
            break;
        case '7':
            echo "siete";
            break;
        case '8':
            echo "ocho";
            break;
        case '9':
            echo "nueve";
            break;

        default:
            # code...
            break;
    }
}
