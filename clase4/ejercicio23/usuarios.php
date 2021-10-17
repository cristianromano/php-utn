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

class Usuario
{

    public $_nombre;
    public $_apellido;
    public $_mail;
    public $_id;
    public $_fecha;
    public $_imagen;

    public function __construct(string $_nombre = null, string $_apellido = null, string $_mail = null , string $_imagen = null)
    {
        $this->_nombre = $_nombre;
        $this->_clave = $_apellido;
        $this->_mail = $_mail;
        $this->_id = rand(1, 100);
        $this->_fecha = date("m.d.y");
        $this->_imagen = $_imagen;
    }

    public static function guardarJSON($objeto)
    {
        $json_string = json_encode($objeto);
        $file = './archivos/clientes.json';
        file_put_contents($file, $json_string);
        // $archivoJSON = fopen('./archivos/clientes.json','a');
        // $objetoJSON = json_encode($objeto).PHP_EOL;
        // fwrite($archivoJSON,$objetoJSON);
        // fclose($archivoJSON);
    }

    public static function leerJSON()
    {
        // $datos_clientes = file_get_contents('./archivos/clientes.json');
        // $json_clientes = json_decode($datos_clientes, true);
        // foreach ($json_clientes as $cliente) {

        //     echo $cliente . "<br>";
        // }
        $datos_productos = file_get_contents('./archivos/productos.json');
        $arrayUsuarios = json_decode($datos_productos, true);

        echo '<ul>';
        foreach ($arrayUsuarios as $usuario) {
          echo '<li>nombre:'. $usuario['_nombre'] . " apellido: ". $usuario['_apellido'] . " ID:" . $usuario['_id'] . '<img src="'.$usuario["_imagen"] .'" /></li>';
        }       
        echo '<ul>';
    }

    
    public static function ObtenerUsuariosJson(){
        // $nombreArchivo = './archivos/clientes.json';
        // $arrayUsuarios = array();
        // $archivo = fopen($nombreArchivo, 'r');
        // while(!feof($archivo)){
        //     $linea = fgets($archivo);
        //     $usuario = json_decode($linea, true);
        //     array_push($arrayUsuarios, $usuario);
        // }
        // fclose($archivo);
        // return $arrayUsuarios;
        $datos_productos = file_get_contents('./archivos/clientes.json');
        $arrayUsuarios = json_decode($datos_productos, true);
        return $arrayUsuarios;
    }






}


?>