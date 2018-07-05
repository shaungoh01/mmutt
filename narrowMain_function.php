<?php 
ini_set('display_errors', 1);
ob_start();
if(!isset($_SESSION)){
	session_start();
} 
if (!isset($_SESSION['timetable'])){
	header('Location: http://' . $_SERVER['HTTP_HOST'] .'/index.php');
	exit();
}
require_once 'time_oop.php';
if(isset($_SESSION['error'])){
	$_SESSION['error']="";
}
	$timetable = json_decode($_SESSION['timetable'],true);
		$dayH3;
		$time = new time_c();
	 	for($a = 0; $a< 5 ; $a++) {
			 switch($a) {
			 	case 0:
			 	$b = 'MON';
			 	$dayH3 = "Monday";
			 	break;
			 
			 	case 1:
			 	$b = 'TUE';
			 	$dayH3 = "Tuesday";
			 	break;
			 	
			 	case 2:
			 	$b = 'WED';
			 	$dayH3 = "Wednesday";
			 	break;
			 	
			 	case 3:
			 	$b = 'THU';
			 	$dayH3 = "Thursday";
			 	break;
			 	
			 	case 4:
			 	$b = 'FRI';
			 	$dayH3 = "Friday";
			 	break;	
			 }
?>
				<h3 style="margin:13px 0;"><?php echo $dayH3; ?></h3>
				<div class="list-group">
<?php
					$ctrigger = 0;
			 	for($c = 8 ; $c<20 ; $c++){
			 		if(isset($timetable[$b][$c]['code'])){
			 			$ctrigger ++;
			 			$lenght = 1;
			 			$trigger = 0;
			 			$c1 = $c;
			 			while($trigger < 1){
							if(isset($timetable[$b][$c + 1]['code'])){
								if(($timetable[$b][$c]['code'] == $timetable[$b][$c1 + 1]['code']) && ($timetable[$b][$c]['session'] == $timetable[$b][$c1 + 1]['session'])){
									$lenght += 1;
									$c1+=1;
								}else{
									$trigger = 1;
								}
							}else{
								$trigger = 1;
							}
						}

						$hour = $time->hour_c($c);
						$am = $time->am_pm($c);
						$hour2 = $time->hour_c($c + $lenght);
						$am2 = $time->am_pm($c + $lenght);
						$minute = '';
						if(isset($timetable[$b][$c]['minute'])){
							$minute = "." . $timetable[$b][$c]['minute'];
						}
						?>
						<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
							<div class="d-flex w-100 justify-content-between">
							<h5 class="mb-1"><?php echo $timetable[$b][$c]['subject']; ?></h5>
							<small class="text-muted"><?php echo $hour .$minute. $am . " - " . $hour2 .$minute. $am2; ?></small>
							</div>
							<p class="mb-1">
								Subject Code <?php echo $timetable[$b][$c]['code'] ?> <br /> 
								Subject <?php echo $timetable[$b][$c]['subject']; ?><br />
								Time <?php echo  $hour .$minute. $am . " - " . $hour2 .$minute. $am2; ?><br />
								Class <?php echo  $timetable[$b][$c]['room'] . " [" . $timetable[$b][$c]['session'] . "]" ?>
							</p>
						</a>
						<?php

						$c+= $lenght -1;

			 		}
			 	}
			 	if($ctrigger == 0){
			 		echo "<div class='slot' style='text-align:center;'>";
			 		echo "You don't have any class today";
			 		echo "</div>";
			 	}
			 	
?>
				</div>
<?php
		}
	 
$_SESSION['timetable'] = json_encode($timetable);
?>