<?php

require_once 'usuario.php';

//Validamos que ingresen datos
$nombre = $_POST["nombre"];
$clave = $_POST["clave"];
$mail = $_POST["mail"];

if(strcmp($nombre,'') == 0 || strcmp($clave,'') == 0 || strcmp($mail,'') == 0){
    echo 'Datos Invalidos';
}else{
    $usuario = new Usuario($nombre, $clave, $mail);
    if(Usuario::GuardarUsuario($usuario)){

        echo 'Datos correctos. Se dio de alta el usuario.';
    }else{
        echo 'Ocurrio un error al guardar los datos.';
    }
}