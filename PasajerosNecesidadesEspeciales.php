<?php
class PasajerosNecesidadesEspeciales extends Pasajeros{
    private $servicioEspecial;//boolean
    private $asistencia;//boolean
    private $comidaEspecial;//boolean

    public function __construct($vNombre, $vNumAsiento, $vNumTicket, $servicioEspecial, $asistencia, $comidaEspecial){
        parent::__construct($vNombre, $vNumAsiento, $vNumTicket);
        $this->servicioEspecial = $servicioEspecial;
        $this->asistencia = $asistencia;
        $this->comidaEspecial = $comidaEspecial;
    }

	public function getServicioEspecial() {
		return $this->servicioEspecial;
	}

	public function setServicioEspecial($servicio) {
		$this->servicioEspecial = $servicio;
	}

	public function getAsistencia() {
		return $this->asistencia;
	}

	public function setAsistencia($asist) {
		$this->asistencia = $asist;
	}

	public function getComidaEspecial() {
		return $this->comidaEspecial;
	}

	public function setComidaEspecial($comida) {
		$this->comidaEspecial = $comida;
	}

    public function darPorcentajeIncremento() {
        if ($this->getServicioEspecial() && $this->getAsistencia() && $this->getComidaEspecial()) {
            return 30;//Si tiene todos los servicios incrementa un 30%
        } elseif ($this->getServicioEspecial() || $this->getAsistencia() || $this->getComidaEspecial()) {
            return 15;//Si tiene al menos un servicio incrementa un 15%
        } else {
            return 10; //Si no tiene servicios un 10%
        }
    }

    public function __toString(){
        return parent::__toString() . 
        "\nRequiere servicio especial: " . $this->getServicioEspecial() . 
        "\nRequiere asistencia: " . $this->getAsistencia() . 
        "\nRequiere comida especial: " . $this->getComidaEspecial();
    }

}
