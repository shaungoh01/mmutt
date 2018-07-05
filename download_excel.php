<?php 
ob_start();
session_start();
error_reporting(E_ALL);
	header("Content-Type: application/vnd.ms-excel");
	header("Content-disposition: attachment; filename=MMU_TimeTable.xls");
	$timetable = json_decode($_SESSION['timetable'],true);
	
	function empty_box($day , $i){
	global $timetable;	
		if($timetable[$day][$i]['code'] == ""){
			echo" \t";
		}else{
			echo $timetable[$day][$i]['code'] . "-" . $timetable[$day][$i]['subject'] ."-". $timetable[$day][$i]['room'] . " [" . $timetable[$day][$i]['session'] . "]" . "\t";
		}

	};
	
	echo" \tMonday\tTuesday\tWednesday\tThursday\tFriday\r\n";
	for($i = 8 ; $i < 22 ; $i++) {
		echo $i;
		echo "-";
		echo $i+1 . "\t"; 
		empty_box("MON",$i);
		empty_box("TUE",$i);
		empty_box("WED",$i); 
		empty_box("THU",$i); 
		empty_box("FRI",$i);
		echo"\r\n";
	}
	$_SESSION['timetable'] = json_encode($timetable);
?>
