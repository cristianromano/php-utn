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

    public $id_usuario;
    public $nombre;
    public $apellido;
    public $clave;
    public $mail;
    public $fecha_de_registro;
    public $localidad;
    // public $imagen;

    public static function crearUsuario(string $nombre = null, string $apellido = null,string $clave = null ,string $mail = null ,string $localidad)
    {
        $usuario = new Usuario();
        $usuario->nombre = $nombre;
        $usuario->apellido = $apellido;
        $usuario->clave = $clave;
        $usuario->mail = $mail;
        $usuario->id_usuario = rand(1, 100);
        $usuario->fecha_de_registro = date("Y-m-d");
        // $usuario->imagen = $imagen;
        $usuario->localidad = $localidad;

        return $usuario;
    }

    public function __construct() {

    }

    public static function guardarJSON($objeto)
    {
        $json_string = json_encode($objeto);
        $file = './archivos/clientes.json';
        file_put_contents($file, $json_string);
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

        $datos_productos = file_get_contents('./archivos/clientes.json');
        $arrayUsuarios = json_decode($datos_productos, true);
        return $arrayUsuarios;
    }

    public function InsertarUsuario()
    {
               $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
               $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO usuario(id_usuario, nombre, apellido, clave, mail, fecha_de_registro, localidad) 
               VALUES (:id,:nombre,:apellido,:clave,:mail,:fecha,:localidad)");
               $consulta->bindValue(':id',$this->id_usuario, PDO::PARAM_INT);
               $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
               $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
               $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
               $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
               $consulta->bindValue(':fecha', $this->fecha_de_registro, PDO::PARAM_STR);
               $consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
               $consulta->execute();		
               return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public static function TraerTodosLosUsuarios()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuario");
			if ($consulta->execute()){
                 return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
            }else{
                echo 'err';
            }						
	}

    public static function MostrarDatos($arrUsuarios){
        $cadena = "<ul>";
        foreach ($arrUsuarios as $x) {
           $cadena.= "<li>". 
           "Nombre:".$x->nombre . " " .
           "Apellido:".$x->apellido . " " .
           "Clave:".$x->clave . " " .
           "Mail:".$x->mail . " " .
           "Fecha Registro:".$x->fecha_de_registro . " " .
           "Localidad:".$x->localidad . " " .
           "ID:".$x->id_usuario ."</li>";
        }
        $cadena.= "</ul>";
        echo $cadena;
    }



}


?>