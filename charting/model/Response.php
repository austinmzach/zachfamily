<?php

class Response {
	
	private $type;
	private $cssClass;
	private $cssIcon;
	private $message;
	
	public function Response ($type, $cssClass, $cssIcon, $message) {
		$this->type = $type;
		$this->cssClass = $cssClass;
		$this->cssIcon = $cssIcon;
		$this->message = $message;
	}
	
	public function getType() {
		return $this->type;
	}
	
	public function getCssClass() {
		return $this->cssClass;
	}
	
	public function getCssIcon() {
		return $this->cssIcon;
	}
	
	public function getMessage() {
		return $this->message;
	}
}

?>