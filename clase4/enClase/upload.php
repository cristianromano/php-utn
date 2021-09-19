<?php

var_dump($_FILES);

// // $_FILES["archivo"];


// $destino = "uploads/".$_FILES["archivo"]["name"];
// // move_uploaded_file($_FILES["archivo"]["tmp_name"],$destino);

// if (move_uploaded_file($_FILES['archivo']['tmp_name'], 'archivoTEXT.txt')) {
//     echo "El fichero es válido y se subió con éxito.\n";
// } else {
//     echo "¡Posible ataque de subida de ficheros!\n";
// }

$dir_subida = 'archivos-subidos/';
$fichero_subido = $dir_subida . basename($_FILES['archivo']['name']);

if (!file_exists($dir_subida)) {
    mkdir('archivos-subidos/', 0777, true);
    
}

if (move_uploaded_file($_FILES['archivo']['tmp_name'], $fichero_subido)) {
    echo "El fichero es válido y se subió con éxito.\n";
} else {
    
    echo "¡Posible ataque de subida de ficheros!\n";
}



?>