<?php
	class time_c{ 
		// ^ time change 
		public function hour_c($hour){
			if ($hour>12){
				$hour = $hour - 12;
			}else{
				$hour = $hour;
			}
			return $hour;
		}
		function am_pm($hour){
			if ($hour>12){
				$am = "pm";
			}else{
				$am = "am";
			}
			return $am;
		}
	}

	class date_c{
		public $year;
		public $month;
		public $day;

		function check_0($c){
			$c1 = substr($c, 0,1);
			if ($c < 10 && $c1 != 0){
				$c = "0".$c;
			}
			return $c;
		}

		function check_date($date){
			$day = substr($date, 8,2); 
			$month = substr($date, 5,2);
			$year = substr($date, 0,4);

			switch ($month) {
				case '01':
				case '03':
				case '05':
				case '07':
				case '08':
				case '10':
				case '12':
					if($day > 31){
						$month = $month +1;
						$extra = $day - 31;
						$day = $extra;
					}
				break;
				
				case '04':
				case '06':
				case '09':
				case '11':
					if($day > 30){
						$month = $month +1;
						$extra = $day - 30;
						$day = $extra;
					}
				break;

				case '02':
					if($year%4 == 0){
						if($day > 29){
						$month = $month +1;
						$extra = $day - 29;
						$day = $extra;
						}
					}else{
						if($day > 28){
						$month = $month +1;
						$extra = $day - 28;
						$day = $extra;
						}
					}
				break;

			}
			if($month > 12){
				$month = "01";
				$year +=1;
			}
			$day = $this->check_0($day);
			$month = $this->check_0($month);
			$date = $year . "-" .$month . "-" . $day;
			return $date;

		}
		
	}
?>