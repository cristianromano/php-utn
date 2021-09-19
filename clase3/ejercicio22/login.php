<?php

require "./clase3/ejercicio20/usuario.php";

$clave = $_POST["clave"];
$mail = $_POST["mail"];

if(isset($clave) && isset($mail)){
echo 'Verificando datos...<br>';
    if(Usuario::ExisteUsuario($clave, $mail)){
        echo 'Usuario existente';
    }else{
        echo 'Usuario no existente';
    }
}else{
    echo 'Error en los datos ingresados.';
}