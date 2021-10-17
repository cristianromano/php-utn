<?php

require_once "./clases/AccesoDatos.php";
require_once "./PDO/productosDAO.php";

// Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
// ,
// crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).

// crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
// si ya existe el producto se le suma el stock , de lo contrario se agrega al documento en un
// nuevo renglón
// Retorna un :
// “Ingresado” si es un producto nuevo
// “Actualizado” si ya existía y se actualiza el stock.
// “no se pudo hacer“si no se pudo hacer
// Hacer los métodos necesarios en la clase

class Productos
{
    public   $id;
    public   $codigo;
    public   $nombre;
    public   $tipo;
    public   $stock;
    public   $precio;
    public  $fecha_de_creacion;
    public  $fecha_de_modificacion;


    // public function __construct($id ,$codigo = '',$nombre = '',$tipo = '',
    // $stock = 0,$precio = 0.0,$fecha_de_creacion = '' ,$fecha_de_modificacion = '') {
    //     $this->id = $id;
    //     $this->codigo = $codigo;
    //     $this->nombre = $nombre;
    //     $this->tipo = $tipo;
    //     $this->stock = $stock;
    //     $this->precio = $precio;
    //     $this->fecha_de_creacion = $fecha_de_creacion;
    //     $this->fecha_de_modificacion = $fecha_de_modificacion;
    // }

     public function __construct( ) {
        
     }


    public static function guardarJSON($objeto)
    {
        $json_string = json_encode($objeto);
        $file = './archivos/productos.json';
        file_put_contents($file, $json_string);   
    }

    public static function leerJSON()
    {
        $datos_productos = file_get_contents('./archivos/productos.json');
        $arrayProductos = json_decode($datos_productos, true);
        echo '<ul>';
        foreach ($arrayProductos as $producto) {
            echo "<li>nombre:" . $producto['nombre'] . " codigo: " . $producto['codigo'] . " ID:" . $producto['id'] .
                " Tipo:" . $producto['tipo'] . " Stock:" . $producto['stock'] . " Precio:" . $producto['precio'] . "</li>";
        }
        echo '<ul>';
    }


    public static function ObtenerProductosJson()
    {
        $datos_productos = file_get_contents('./archivos/productos.json');
        $arrayProductos = json_decode($datos_productos, true);
         return $arrayProductos;
    }


    public static function verificarJSON($producto)
    {
        $retorno = false;
        $arrAux = array();
        $datos_productos = file_get_contents('./archivos/productos.json');
        $arrayProductos = json_decode($datos_productos, true);
        foreach ($arrayProductos as $prod) {
            if (strcmp($prod['codigo'], $producto->codigo) == 0) {
                echo 'ya existe , se agrega stock';
                $prod['stock'] += $producto->stock;
                array_push($arrAux,$prod);
                $retorno = true;
            }else{
                array_push($arrAux,$prod);
            }
        }

        $json_string = json_encode($arrAux);
        $file = './archivos/productos.json';
        file_put_contents($file, $json_string);
        
        return $retorno;
    }

    // public static function EliminarStock($producto)
    // {
    //     $retorno = false;
    //     $arrAux = array();
    //     $datos_productos = file_get_contents('./archivos/productos.json');
    //     $arrayProductos = json_decode($datos_productos, true);
    //     foreach ($arrayProductos as $prod) {
    //         if (strcmp($prod['codigo'], $producto->codigo) == 0) {
    //             echo 'se quita stock';
    //             $prod['stock'] -= $producto->stock;
    //             array_push($arrAux,$prod);
    //             $retorno = true;
    //         }else{
    //             array_push($arrAux,$prod);
    //         }
    //     }

    //     $json_string = json_encode($arrAux);
    //     $file = './archivos/productos.json';
    //     file_put_contents($file, $json_string);
        
    //     return $retorno;
    // }

    public static function EliminarStockArr($producto)
    {
        $retorno = false;
        $arrAux = array();
        $datos_productos = file_get_contents('./archivos/productos.json');
        $arrayProductos = json_decode($datos_productos, true);
        foreach ($arrayProductos as $prod) {
            if (strcmp($prod['codigo'], $producto['codigo']) == 0) {
                // echo 'se quita stock';
                $prod['stock'] -= $producto['stock'];
                array_push($arrAux,$prod);
                $retorno = true;
            }else{
                array_push($arrAux,$prod);
            }
        }

        $json_string = json_encode($arrAux);
        $file = './archivos/productos.json';
        file_put_contents($file, $json_string);
        
        return $retorno;
    }

    public function setStock($producto)
    {
        $this->stock = $producto->stock;
    }

    public static function TraerTodosLosProductos()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM producto");
			if ($consulta->execute()){
                 return $consulta->fetchAll(PDO::FETCH_CLASS, "Productos");
            }else{
                echo 'err';
            }						
	}

    public static function MostrarDatos($arrProductos){
        $cadena = "<ul>";
        foreach ($arrProductos as $x) {
           $cadena.= "<li>". 
           "Nombre:".$x->nombre . " " .
           "Codigo:".$x->codigo . " " .
           "Tipo:".$x->tipo . " " .
           "Stock:".$x->stock . " " .
           "Fecha Creacion:".$x->fecha_de_creacion . " " .
           "Fecha Modificacion:".$x->fecha_de_modificacion . " " .
           "ID:".$x->id ."</li>";
        }
        $cadena.= "</ul>";
        echo $cadena;
    }



}


?>