<?php

require_once("ChartingDao.php");

class Observation {
	
	private $date;
	private $formattedDate;
	private $observation;
	private $observation2;
	private $intercourse;
	private $cycleStarter;
	private $background;
	
	public function determineBackground() {
		if ($this->isRed())
			return "red";
		else if ($this->isWhiteBaby())
			return "url('images/white_baby.jpg')";
		else if ($this->isYellowBaby())
			return "url('images/yellow_baby.jpg')";
		else if ($this->isGreenBaby())
			return "url('images/green_baby.jpg')";
		else
			return "green";
	}
	
	public function isRed() {
		if (strstr($this->observation, "H") !== false || strstr($this->observation, "M") !== false || strstr($this->observation, "B") !== false || strstr($this->observation, "V") !== false)
			return true;
		else
			return false;
	}
	
	public function isWhiteBaby() {
		if (strstr($this->observation, "10") !== false || strstr($this->observation, "K") !== false || strstr($this->observation, "L") !== false)
			return true;
		else
			return false;
	}
	
	public function isGreenBaby() {
		$chartingDao = new ChartingDao();
		$prevObservations = $chartingDao->getRecentObservations();
		
		foreach ($prevObservations as $prevObservation) {
			if ($prevObservation->isWhiteBaby())
				return true;
		}
		
		return false;
	}
	
	public function isYellowBaby() {
		if ($this->isGreenBaby() && (strstr($this->observation, "6") !== false || strstr($this->observation, "8") !== false || strstr($this->observation, "10") !== false))
			return true;
		else
			return false;
	}
	
	/*----------------------------*/
	/* PUBLIC GETTERS AND SETTERS */
	/*----------------------------*/
	public function getDate() {
		return $this->date;
	}
	
	public function getFormattedDate() {
		return $this->formattedDate;
	}
	
	public function getObservation() {
		return $this->observation;
	}
	
	public function getObservation2() {
		return $this->observation2;
	}
	
	public function getIntercourse() {
		return $this->intercourse;
	}
	
	public function getCycleStarter() {
		return $this->cycleStarter;
	}
	
	public function getBackground() {
		return $this->background;
	}
	
	public function setDate($date) {
		$this->date = $date;
	}
	
	public function setFormattedDate($formattedDate) {
		$this->formattedDate = $formattedDate;
	}
	
	public function setObservation($observation) {
		$this->observation = $observation;
	}
	
	public function setObservation2($observation2) {
		$this->observation2 = $observation2;
	}
	
	public function setIntercourse($intercourse) {
		$this->intercourse = $intercourse;
	}
	
	public function setCycleStarter($cycleStarter) {
		$this->cycleStarter = $cycleStarter;
	}
	
	public function setBackground($background) {
		$this->background = $background;
	}
}

?>