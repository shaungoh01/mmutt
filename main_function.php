<?php 
ini_set('display_errors', 1);
ob_start();
if(!isset($_SESSION)){
	session_start();
} 
if (!isset($_SESSION['timetable'])){
	header('Location: index.php');
	exit();
}
require_once 'time_oop.php';
if(isset($_SESSION['error'])){
	$_SESSION['error']="";
}
	$timetable = json_decode($_SESSION['timetable'],true);
	echo "<table style='border:solid; border-width:1px; border-collapse:collapse; margin:0;'><tr><td style='border:solid; border-width:1px;'></td><td style='border:solid; border-width:1px;'>Monday</td><td style='border:solid; border-width:1px;'>Tuesday</td><td style='border:solid; border-width:1px;'>Wednesday</td><td style='border:solid; border-width:1px;'>Thrsday</td><td style='border:solid; border-width:1px;'>Friday</td></tr>";
	$i3 = 8; //3 counter for time table output//
	$skip = 0;
	$hour;
	$hour2;
	$am; //am or pm
	$am2;
	$rowskip = array(array());
	while ($i3 < 23){
		if( empty($timetable['MON'][$i3]['code']) && empty($timetable['TUE'][$i3]['code']) && empty($timetable['WED'][$i3]['code']) && empty($timetable['THU'][$i3]['code']) && empty($timetable['FRI'][$i3]['code']) && $skip==0 ){
			$i3++;
			continue;
		}

		$skip = 1;
		echo "<tr style='height:50px;'><td style='border-top-style:solid; border-width:1px; text-align:center; width:10%;'>";
		$i3a = $i3 + 1;
		$time = new time_c();
		$hour = $time->hour_c($i3);
		$am = $time->am_pm($i3);
		$hour2 = $time->hour_c($i3a);
		$am2 = $time->am_pm($i3a);
		echo $hour . $am ." - " .$hour2.$am2 ;
		echo "</td>"; 	 
	 	for($a = 0; $a< 5 ; $a++) {
			 switch($a) {
			 	case 0:
			 	$b = 'MON';
			 	break;
			 
			 	case 1:
			 	$b = 'TUE';
			 	break;
			 	
			 	case 2:
			 	$b = 'WED';
			 	break;
			 	
			 	case 3:
			 	$b = 'THU';
			 	break;
			 	
			 	case 4:
			 	$b = 'FRI';
			 	break;
			 	
			 }	/*
			 		$lenght = 1;
			 		$trigger = 0;
					$ib = $i3;
					while($trigger < 1){
						if(isset($timetable[$b][$ib + 1]['code'])){
							if(($timetable[$b][$ib]['code'] == $timetable[$b][$ib + 1]['code']) && ($timetable[$b][$ib]['session'] == $timetable[$b][$ib + 1]['session'])){
								$lenght += 1;
								$ib++;
							}else{
								$trigger = 1;
							}
						}else{
							$trigger = 1;
						}
					}*/

			 	if(isset($rowskip[$i3][$a] ) && $rowskip[$i3][$a] == 1){
			 		continue;
			 	}else if (empty($timetable[$b][$i3]['subject'])){
					echo "<td style='border:solid; border-width:0 1px; width:18%;'></td>";
				}else if( ( empty($timetable[$b][$i3-1]['subject'])) || ( $timetable[$b][$i3-1]['code'] != $timetable[$b][$i3]['code'])){ 
					echo "<td rowspan='".$timetable[$b][$i3]['lenght']."' style='background-color:#a6baff; border:solid; border-width:1px; text-align:center; width:18%;'>";
					echo "Subject : " .$timetable[$b][$i3]['code'] ." - ". $timetable[$b][$i3]['subject'] . "<br />";
					echo "Class : " . $timetable[$b][$i3]['room'] . " [" . $timetable[$b][$i3]['session'] . "]";
					echo "</td>";
					for($leng = 1; $leng < $timetable[$b][$i3]['lenght'] ; $leng ++){
						$i3new = $i3 + $leng;
						$rowskip[$i3new][$a] = 1;
					}
				}
		}
	 
	 	echo "</tr>";
	$i3++;
	}
	unset($time);
echo "</table>";
$_SESSION['timetable'] = json_encode($timetable);
?>