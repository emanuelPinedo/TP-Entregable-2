<?php
class ResponsableV{
    private $nroEmpleado;
    private $nroLicencia;
    private $nombre;
    private $apellido;

    //metodo constructor
    public function __construct($nroEmpleado,$nroLicencia,$nombre,$apellido) {
        $this->nroEmpleado = $nroEmpleado;
        $this->nroLicencia = $nroLicencia;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    //metodo de acceso (gets)
    public function getNroEmpleado(){
        return $this->nroEmpleado;
    }

    public function getNroLicencia(){
        return $this->nroLicencia;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    //metodo de modificacion (sets)
    public function setNroEmpleado($numEmple){
        $this->nroLicencia = $numEmple;
    }

    public function setNroLicencia($numLic){
        $this->nroLicencia = $numLic;
    }

    public function setNombre($name){
        $this->nombre = $name;
    }

    public function setApellido($apell){
        $this->apellido = $apell;
    }

    //metodo transformador
    public function __toString() {
        return "\nNombre de Responsable del viaje: " . $this->getNombre() . 
        "\nApellido: " . $this->getApellido() . 
        "\nNúmero de Empleado: " . $this->getNroEmpleado() . 
        "\nNúmero de Licencia: " . $this->getNroLicencia();
    }

}