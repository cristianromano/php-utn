<?php
//https://www.php.net/manual/es/function.date.php

$hoy = date("F j, Y, g:i a");
$mes = date("F");

echo $hoy;
echo '<br>';


switch ($mes) {
    case 'January':
        echo('verano');
        break;
    case 'February':
        echo('verano');
        break;
    case 'March':
        echo('otonio');
        break;
    case 'April':
        echo('otonio');
        break;
    case 'May':
        echo('otonio');
        break;
    case 'June':
        echo('otonio');
        break;
    case 'July':
        echo('invierno');
        break;
    case 'August':
        echo('invierno');
        break;
    case 'September':
        echo('privamera');
        break;
    case 'October':
        echo('privamera');
        break;
    case 'November':
        echo('privamera');
        break;
    case 'December':
        echo('verano');
        break;

    default:
    echo('dd');
        break;
}
