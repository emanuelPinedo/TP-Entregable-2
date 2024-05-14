<?php
class Pasajero{
    private $nombre;
    private $numAsiento;
    private $numTicketPasaje;

	public function __construct($nombre, $numAsiento, $numTicketPasaje) {
		$this->nombre = $nombre;
		$this->numAsiento = $numAsiento;
		$this->numTicketPasaje = $numTicketPasaje;
	}

	public function getNombre() {
		return $this->nombre;
	}

	public function setNombre($name) {
		$this->nombre = $name;
	}

	public function getNumAsiento() {
		return $this->numAsiento;
	}

	public function setNumAsiento($nroAsiento) {
		$this->numAsiento = $nroAsiento;
	}

	public function getNumTicketPasaje() {
		return $this->numTicketPasaje;
	}

	public function setNumTicketPasaje($numTicket) {
		$this->numTicketPasaje = $numTicket;
	}

	public function darPorcentajeIncremento(){
		return 10;
	}
}