<?php

class Counttime
{
	
	public function countCaseTime($start, $finish) {
		$datetime1 = new DateTime($start);
		$datetime2 = new DateTime($finish);
		$interval = $datetime1->diff($datetime2);

		if ($interval->format("%a") == 0 && $interval->format("%H") == 00 && $interval->format("%i") == 00) {
		   $x = $interval->format("%s detik");
		} elseif ($interval->format("%a") == 0 && $interval->format("%H") == 00) {
		   $x = $interval->format("%i menit %s detik");
		} elseif ($interval->format("%a") == 0) {
		   $x = $interval->format("%H jam %i menit %s detik");
		} else {
		   $x = $interval->format("%a hari  %H jam %i menit %s detik");
		}

		return $x;
	}

}