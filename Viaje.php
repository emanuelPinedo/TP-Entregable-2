<?php
class Viaje {
    private $codigo;
    private $destino;
    private $cantidadMaxPasajeros;
    private $coleObjPasajero = array(); // Arreglo de la coleccion de pasajeros
    private $objResponsableViaje; // Objeto responsable del viaje
    private $costoViaje;
    private $costosAbonados;

    //metodo constructor
    public function __construct($codigo,$destino,$cantidadMaxPasajeros,$coleObjPasajero,$objResponsableViaje,$costoViaje,$costosAbonados){
        $this->codigo = $codigo;
        $this->destino = $destino;
        $this->cantidadMaxPasajeros = $cantidadMaxPasajeros;
        $this->coleObjPasajero = $coleObjPasajero;
        $this->objResponsableViaje = $objResponsableViaje;
        $this->costoViaje = $costoViaje;
        $this->costosAbonados = $costosAbonados;
    }

    //metodo de acceso

    public function getCodigo (){
        return  $this->codigo;
    }

    public function getDestino (){
        return  $this->destino;
    }

    public function getCantidadMaxPasajeros (){
        return  $this->cantidadMaxPasajeros;
    }

    public function getColeObjPasajero (){
        return  $this->coleObjPasajero;
    }

    public function getObjResponsableViaje (){
        return  $this->objResponsableViaje;
    }

    public function getCostoViaje (){
        return  $this->costoViaje;
    }

    public function getCostosAbonados (){
        return  $this->costosAbonados;
    }

    //metodo de modificacion
    public function setCodigo ($codigo){
        $this->codigo = $codigo;
    }

    public function setDestino ($destino){
        $this->destino = $destino;
    }

    public function setCantidadMaxPasajeros ($cantidadMaxPasajeros){
        $this->cantidadMaxPasajeros = $cantidadMaxPasajeros;
    }

    public function setColeObjPasajero ($coleObjPasajero){
        $this->coleObjPasajero = $coleObjPasajero;
    }

    public function setObjResponsableViaje ($objResponsableViaje){
        $this->objResponsableViaje = $objResponsableViaje;
    }

    public function setCostoViaje ($costoViaje){
        $this->costoViaje = $costoViaje;
    }

    public function setCostosAbonados ($costosAbonados){
        $this->costosAbonados = $costosAbonados;
    }

    //metodos

    public function agregarCambiarResponsable ($objResponsable){
       $this->setObjResponsableViaje($objResponsable);
    }

    public function hayPasajesDisponible(){
        $maxPersonas = $this->getCantidadMaxPasajeros();
        $cantPersonasActuales = count($this->getColeObjPasajero());
        $rta = false;
        if ($cantPersonasActuales < $maxPersonas) {
            $rta = true;
        }
        return $rta;
    }

    public function agregarPasajero($pasajero){
        $arregloPasajeros = $this->getColeObjPasajero();
        $pasajeroRepetido = false;
        $contadorPasajeros = count($arregloPasajeros);
        $i = 0;
        //verificar si el pasajero ya existe en la coleccion
        while (!$pasajeroRepetido && $i<$contadorPasajeros) {
            if ($arregloPasajeros[$i]->getTicketPasaje() === $pasajero->getNumTicketPasaje()) {
                $pasajeroRepetido = true;
            } else {
                $i++;
            }
        }
        $cambiarPasajero = true;
        //verificar si se puede agregar el pasajero al viaje
        if (!$pasajeroRepetido) {
            array_push($arregloPasajeros, $pasajero);
           $this->setColeObjPasajero($arregloPasajeros);
        } else{
            $cambiarPasajero = false;
        } 
        return $cambiarPasajero;
    }

    public function imprimirPasajeros(){
        $msj = "";
        $i = 1;
        foreach ($this->getColeObjPasajero() as $pasajero) {
            if($pasajero instanceof PasajeroVIP){
                $msj .= "Pasajero ". $i . ":\nTipo: VIP\n" . $pasajero . "\n----------------\n";
            } elseif ($pasajero instanceof PasajerosNecesidadesEspeciales) {
                $msj .= "Pasajero " . $i . ":\nTipo: Especial\n" . $pasajero . "\n----------------\n";
            } else {
                $msj .= "Pasajero " . $i . ":\nTipo: Común\n" . $pasajero . "\n----------------\n";
            }
            $i++;
        }

        return $msj;
    }

    public function modificarPasajero($nombreNuevo,$asientoNuevo,$ticketPasajero){
        $pasajGuardado = $this->getColeObjPasajero();
        $cambiar = false;
        foreach ($pasajGuardado as $pasaj){
            if($pasaj->getNumTicketPasaje() === $ticketPasajero){
                $pasaj->setNombre($nombreNuevo);
                $pasaj->setNumAsiento($asientoNuevo);
                $cambiar = true;//Si entra el if, permitió cambiar los datos, retornará true.
            }
        }
        return $cambiar;
    }

    public function modificarEmpleado($numeroLicencia, $nombreNuevoEmpleado, $apellidoNuevoEmpleado, $numeroNuevoEmpleado) {
        $empleadoResponsable = $this->getObjResponsableViaje();
        $cambiar = false;//Si no permite cambiar los datos del empleado retornará false.
        foreach ($empleadoResponsable as $empleado){
            if ($empleado->getNroLicencia() === $numeroLicencia){
                $empleadoResponsable->setNombre($nombreNuevoEmpleado);
                $empleadoResponsable->setApellido($apellidoNuevoEmpleado);
                $empleadoResponsable->setNroEmpleado($numeroNuevoEmpleado);
                $cambiar = true;//Si entra el if, permitió cambiar los datos, retornará true.
            }
        }
        return $cambiar;
    }

    public function venderPasaje($objPasajero){;
        $this->getColeObjPasajero()[] = $objPasajero;
        $precioPasaje = $this->getCostoViaje();
        $costoAbonado = -1;
        if ($this->hayPasajesDisponible()) {
            $pasajeroNoRepetido = $this->agregarPasajero($objPasajero);
            if ($pasajeroNoRepetido) {
                $porcentajeIncremento = $objPasajero->darPorcentajeIncremento();
                $costoAbonado = $precioPasaje * (1 + $porcentajeIncremento);
                $this->setCostosAbonados($costoAbonado);
            }
        }
        return $costoAbonado;
    }


    public function __toString(){
        return "DATOS DEL VIAJE: " .
        "\n_________________________________________________" .
        "\nCódigo de viaje: " . $this->getCodigo() .
        "\nDestino: " . $this->getDestino() .
        "\nCantidad máxima de pasajeros: " . $this->getCantidadMaxPasajeros() .
        "\nResponsable del viaje: \n" . $this->getObjResponsableViaje() .
        "\nCosto del viaje: " . $this->getCostoViaje() .
        "\nCostos abonados por los pasajeros: " . $this->getCostosAbonados() .
        "\n----------------\n" .
        "\nPasajeros:\n" . $this->imprimirPasajeros() .
        "\n_________________________________________________";
}
}