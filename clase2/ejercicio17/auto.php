<?php

class Auto
{
    private $_color;
    private $_marca;
    private $_precio;
    private $_fecha;

    public function __construct(string $_color = "", string $_marca = "", float $_precio = 0, DateTime $_fecha = null)
    {
        $this->_color = $_color;
        $this->_marca = $_marca;
        $this->_precio = $_precio;
        $this->_fecha = date("m.d.y");
    }

    // Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble por
    // parámetro y que se sumará al precio del objeto.
    // Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto”
    // por parámetro y que mostrará todos los atributos de dicho objeto.
    // Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
    // devolverá TRUE si ambos “Autos” son de la misma marca.

    // Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son
    // de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con
    // la suma de los precios o cero si no se pudo realizar la operación.
    // Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);
    // En testAuto.php:

    public static function Add(Auto $autoUno, Auto $autoDos)
    {
        $retorno = 0;
        if (strcmp($autoUno->getMarca(), $autoDos->getMarca()) == 0 && strcmp($autoUno->getColor(), $autoDos->getColor()) == 0) {
            return $retorno = $autoUno->getPrecio() + $autoDos->getPrecio();
        }
        return $retorno;
    }


    public function AgregarImpuestos($monto)
    {
        $this->_precio += $monto;
    }

    public static function MostrarAuto(Auto $auto)
    {
        echo "Color:" . $auto->getColor() . " Marca:" . $auto->getMarca() . " Precio:" . $auto->getPrecio() . " Fecha:" . $auto->getFecha() . "<br>";
    }

    // public static function MostrarAutosCSV()
    // {
    //     $arr = Auto::leerAutos();
    //     foreach ($arr as $key => $value) {
    //         echo "Color:" . $value->getColor() . " Marca:" . $value->getMarca() . " Precio:" . $value->getPrecio() . " Fecha:" . $value->getFecha() . "\n";# code...
    //     }
        
    // }

    public function IgualesMarca(Auto $auto)
    {
        if (strcmp($auto->getMarca(), $this->getMarca()) == 0) {
            return true;
        }
        return false;
    }

    public static function guardarAutos(Auto $autos)
    {
        $arrAutos = array("marca" => $autos->_marca);
        $fopen = fopen('autos.csv', 'a');
        foreach ($arrAutos as $auto) {
            fputcsv($fopen,(array) $auto);
        }
        fclose($fopen);

        return $arrAutos;
    }

    public static function leerAutos(){
        
        $arrAutos = array();
        $fopen = fopen("autos.csv",'r');
        while (($data = fgetcsv($fopen, 1000, ",")) !== FALSE) {
            var_dump($data);
           $lista = new Auto($data[0],$data[1],$data[2] , $data[3]);
            array_push($arrAutos,$lista);
        }
        fclose($fopen);
    }

    public function getColor()
    {
        return $this->_color;
    }
    public function getMarca()
    {
        return $this->_marca;
    }
    public function getPrecio()
    {
        return $this->_precio;
    }
    public function getFecha()
    {
        return $this->_fecha;
    }
}
