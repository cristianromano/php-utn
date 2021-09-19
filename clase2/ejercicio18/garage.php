<?php

require_once "../ejercicio17/auto.php";

class Garage
{

    private $_razonSocial;
    private $_precioPorHora;
    private $_autos = [];

    function __construct()
	{
		//obtengo un array con los parámetros enviados a la función
		$params = func_get_args();
		//saco el número de parámetros que estoy recibiendo
		$num_params = func_num_args();
		//cada constructor de un número dado de parámtros tendrá un nombre de función
		//atendiendo al siguiente modelo __construct1() __construct2()...
		$funcion_constructor ='__construct'.$num_params;
		//compruebo si hay un constructor con ese número de parámetros
		if (method_exists($this,$funcion_constructor)) {
			//si existía esa función, la invoco, reenviando los parámetros que recibí en el constructor original
			call_user_func_array(array($this,$funcion_constructor),$params);
		}
	}

    public function __construct2(string $_razonSocial, float $_precioPorHora)
    {
        $this->_razonSocial = $_razonSocial;
        $this->_precioPorHora = $_precioPorHora;
    }

    public function __construct1(string $_razonSocial)
    {
        $this->__construct2($_razonSocial, 0);
    }


    public function Equals(Auto $auto){
        $retorno = false;
        foreach ($this->_autos as  $autos) {
            if ($autos == $auto){
               $retorno = true;
               break;
            }
        }
        return $retorno;
    }

    public function Add(Auto $auto){
        if ($this->Equals($auto) == false) {
            array_push($this->_autos,$auto);
            echo "agregado al garage";
        }else{
            echo "ya esta en el garage";
        }
    }

    public function Remove(Auto $auto){
        if ($this->Equals($auto) == true) {
            $clave = array_search($auto , $this->_autos);
            unset($this->_autos[$clave]);
            echo "eliminado del garage";
        }else{
            echo "no esta en el garage";
        }
    }

    public function MostrarGarage(){
        echo "Razon Social:" . $this->getRazonSocial() . "<br>" . "Precio x Hora:" . $this->getPrecioPorHora();
        echo "<br>";
        foreach ($this->_autos as $value) {
           Auto::MostrarAuto($value);
        }
    }


    public function getRazonSocial()
    {
        return $this->_razonSocial;
    }
    public function getPrecioPorHora()
    {
        return $this->_precioPorHora;
    }
    public function getAutos()
    {
        return $this->_autos;
    }
}
