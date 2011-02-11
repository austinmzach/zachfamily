<?php

require_once("Cycle.php");
require_once("Observation.php");

class Chart {
	
	private $cycles = array();
	private $longestCycle = 0;
	
	public function draw() {
		ob_start();
		?>
		
		<table class="chart" style="margin-left:15px;">
			<?php 
				foreach ($this->cycles as $cycle) {
					echo "<tr>\n";

					$observations = $cycle->getObservations();
					
					$count = 0;
					foreach($observations as $observation) {
						if ($count % 7 == 0)
							echo "<td style='border-left:3px solid gray;'><span class='stamp' style=\"background:" . $observation->getBackground() . ";\"></span></td>";
						else
							echo "<td><span class='stamp' style=\"background:" . $observation->getBackground() . ";\"></span></td>";
						
						$count++;
					}
					
					for ($count; $count < $this->longestCycle; $count++) {
						if ($count % 7 == 0)
							echo "<td style='border-left:3px solid gray;'><span class='stamp'></span></td>";
						else
							echo "<td><span class='stamp'></span></td>";
					}
				
					echo "\n</tr>\n<tr class='alt'>\n";
						
					$count = 0;
					foreach($observations as $observation) {
						if ($count % 7 == 0)
							echo "<td onclick=\"openDialog()\" style='border-left:3px solid gray;'>";
						else
							echo "<td onclick=\"openDialog()\">";
							
						echo "<span class='stamp'>";
						echo $observation->getFormattedDate() . "<br />";
				    	echo $observation->getObservation() . "<br />";
				    	echo $observation->getObservation2();
				    	
				    	if ($observation->getIntercourse())
				    		echo "<span class='i'>I</span>";
				    	echo "</span></td>";
				    	
				    	$count++;
					}
					
					for ($count; $count < $this->longestCycle; $count++) {
						if ($count % 7 == 0)
							echo "<td style='border-left:3px solid gray;'><span class='stamp'></span></td>";
						else
							echo "<td><span class='stamp'></span></td>";
					}
					
					echo "</tr>\n";
				}
			?>
		</table>
		
		<?php
		$output = ob_get_clean();
		echo $output; 
	}
	
	public function add($cycle) {
		$this->cycles[count($this->cycles)] = $cycle;
	}
	
	public function getCycles() {
		return $this->cycles;
	}
	
	public function calculateLongestCycle() {
		foreach ($this->cycles as $cycle) {
			$count = 0;
			foreach ($cycle->getObservations() as $observation) {
				$count++;
			}
			if ($count > $this->longestCycle)
				$this->longestCycle = $count;
		}
	}
}

?>