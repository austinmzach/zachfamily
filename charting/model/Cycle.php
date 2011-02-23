<?php 

require_once("Observation.php");

class Cycle {
	
	private $observations = array();
	
	public function add($observation) {
		$this->observations[count($this->observations)] = $observation;
	}
	
	public function getObservations() {
		return $this->observations;
	}
}

?>