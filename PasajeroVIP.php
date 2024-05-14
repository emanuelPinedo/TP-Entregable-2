<?php
include 'Pasajero.php';
class PasajeroVIP extends Pasajero{
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
			$porc += 30;
		}
		return $porc;
	}

}