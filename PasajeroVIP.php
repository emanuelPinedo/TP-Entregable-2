<?php
include 'Pasajeros.php';
class PasajeroVIP extends Pasajeros{
    private $numViajero;
    private $cantMillas;

	public function __construct($vNombre, $vNumAsiento, $vNumTicket, $numViajero, $cantMillas) {
        parent::__construct($vNombre, $vNumAsiento, $vNumTicket);
		$this->numViajero = $numViajero;
		$this->cantMillas = $cantMillas;
	}

	public function getNumViajero() {
		return $this->numViajero;
	}

	public function setNumViajero($value) {
		$this->numViajero = $value;
	}

	public function getCantMillas() {
		return $this->cantMillas;
	}

	public function setCantMillas($value) {
		$this->cantMillas = $value;
	}

	public function darPorcentajeIncremento(){
		$porc = 35;
		if($this->getCantMillas() > 300){
			$porc = 30;
		}
		return $porc;
	}

	public function __toString(){
		return parent::__toString() . 
		"\nNúmero de viajero frecuente: ". $this->getNumViajero() . 
		"\nCantidad de millas: ". $this->getCantMillas();
	}
}