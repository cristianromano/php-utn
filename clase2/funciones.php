<?php

// Aplicación No 12 (Invertir palabra)
// Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
// de las letras del Array.
// Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.


function invertirPalabra($palabra){
    $palabraArr = str_split($palabra);
    // var_dump($palabraArr);
    // "<br>";
    $palabraInvertida = [];
    $j = 0;
    $contador = count($palabraArr);

    for ($i=count($palabraArr)-1 ; $j < $contador ; $i--) { 
        $palabraInvertida[$j] = $palabraArr[$i];
        $j++;
    }
    echo implode($palabraInvertida);
    
}

// Crear una función que reciba como parámetro un string ($palabra) y un entero ($max). La
// función validará que la cantidad de caracteres que tiene $palabra no supere a $max y además
// deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
// “Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán:
// 1 si la palabra pertenece a algún elemento del listado.
// 0 en caso contrario.


function contadorPalabras($palabra , $max){

    $retorno = 0;
    $arr = array("Recuperatorio" , "Parcial" , "Programacion");
    $palabraArr = str_split($palabra);

    if(!(count($palabraArr)>$max)){
        for ($i=0; $i < count($arr) ; $i++) { 
            if(strcmp($palabra,$arr[$i]) == 0) {
                $retorno =  1;
                break;
            }
        }
    }
    return $retorno;
}