<?php

// Aplicación No 23 (Registro JSON)
// Archivo: registro.php
// método:POST
// Recibe los datos del usuario(nombre, clave,mail )por POST ,
// crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
// crear un dato con la fecha de registro , toma todos los datos y utilizar sus métodos para
// poder hacer el alta,
// guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
// Usuario/Fotos/.
// retorna si se pudo agregar o no.
// Cada usuario se agrega en un renglón diferente al anterior.
// Hacer los métodos necesarios en la clase usuario.

require_once "usuario.php";


// $nombre = $_POST['nombre'];
// $apellido = $_POST['apellido'];
// $mail = $_POST['mail'];
// $dir_subida = 'Usuario/Fotos/';
// $fichero_subido = $dir_subida . basename($_FILES['foto']['name']);
$opcion = $_POST['opcion'];


// if (!file_exists($dir_subida)) {
//     mkdir('Usuario/Fotos/', 0777, true);   
// }

// if(isset($nombre) && isset($apellido) && isset($mail) && move_uploaded_file($_FILES['foto']['tmp_name'], $fichero_subido) ){
    
//     $usuario = new usuario($nombre,$apellido,$mail,$_FILES['foto']['name']);
//     usuario::guardarJSON($usuario);
//     echo 'login exitoso';
// }

switch($opcion){
    case 'leer':
        usuario::leerJSON();
        break;
}
