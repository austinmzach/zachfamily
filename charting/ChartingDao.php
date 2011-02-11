<?php

require_once("model/Chart.php");
require_once("model/Cycle.php");
require_once("model/Observation.php");
require_once("model/Response.php");

class ChartingDao {
	
	private $con;
	private $db;
	private $chart;
	
	public function ChartingDao() {
		/*----------------------------*/
		/* SET UP DATABASE CONNECTION */
		/*----------------------------*/
		$hostname='zachfamily.db.6874509.hostedresource.com';
		$username='zachfamily';
		$password='August7';
		$dbname='zachfamily';
		
		$this->con = mysql_connect($hostname, $username, $password) OR DIE ('Unable to connect to database! Please try again later.');
		$this->db = mysql_select_db($dbname);
		
		$this->chart = new Chart();
	}
	
	public function getRecentObservations() {
		$query = "select * from chart order by date desc";
		$result = mysql_query($query);
		$observations = array();
		$observations[0] = $this->toObservation(mysql_fetch_array($result));
		$observations[1] = $this->toObservation(mysql_fetch_array($result));
		$observations[2] = $this->toObservation(mysql_fetch_array($result));
		
		return $observations;
	}
	
	public function toObservation($row) {
		$observation = new Observation();
		$observation->setDate($row['date']);
		$dateParts = date_parse($row['date']);
		$observation->setFormattedDate($dateParts['month'] . "/" . $dateParts['day']);
		$observation->setObservation($row['obs_line1']);
		$observation->setObservation2($row['obs_line2']);
		$observation->setIntercourse($row['intercourse']);
		$observation->setCycleStarter($row['cycleStarter']);
		$observation->setBackground($row['background']);
		
		return $observation;
	}
	
	public function insertObservation($observation) {
		$query = "select * from chart order by date desc";
		$result = mysql_query($query);
		$prevObservation = $this->toObservation(mysql_fetch_array($result));
		
		$prevDate = date_parse($prevObservation->getDate());
		$currDate = date_parse($observation->getDate());
		
		if ($prevDate['year'] == $currDate['year'] && $prevDate['day'] + 1 == $currDate['day']) {
			if (!$prevObservation->isRed() && $observation->isRed())
				$observation->setCycleStarter(1);
			else
				$observation->setCycleStarter(0);
		} else {
			$observation->setCycleStarter(0);
		}
		
		$query = "insert into chart (date, obs_line1, obs_line2, intercourse, cycleStarter, background)"
			. "values ('" . $observation->getDate() . "','" . $observation->getObservation() . "','" . $observation->getObservation2() . "','" . $observation->getIntercourse() .  "','" . $observation->getCycleStarter() . "','" . $observation->getBackground() . "')";
			
		if (mysql_query($query))
			return new Response("Success! ", "highlight", "info", "Your observation has been recorded.");
		else
			return new Response("Error: ", "error", "alert", mysql_error());
	}
	
	public function getChart() {
		$query = "select *, DATE_FORMAT(date,'%c/%e') as formatted_date from chart order by date";
		$result = mysql_query($query);
		
		while ($row = mysql_fetch_array($result)) {
			$observation = $this->toObservation($row);
			
			if ($observation->getCycleStarter())
				$cycle = new Cycle();
			
			$cycle->add($observation);
			
			if ($observation->getCycleStarter())
				$this->chart->add($cycle);
		}
		
		$this->chart->calculateLongestCycle();
		return $this->chart;
	}
}

?>