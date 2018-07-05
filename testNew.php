<?php

$id = 1122701194;
$psw = X393353351;


$vlogin =  "http://camsys.volzel.net/timetable";
	$ch = curl_init($vlogin);
	curl_setopt($ch ,CURLOPT_URL, $vlogin);
	curl_setopt($ch ,CURLOPT_POST , 1);
	curl_setopt($ch ,CURLOPT_FAILONERROR , 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'username='. $id .'&password=' . $psw);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
	$result_json = curl_exec($ch);
	curl_close($ch);
	$result = json_decode($result_json,true);
	print_r($result);
	//print count($result[0]["slots"]);
	//print $result[0]['slots'][1]['section'];
/*
	$i = 0;
	$counter = count($result);
	//print $counter;
	while( $i < $counter ){
		$slot_count = count($result[$i]["slots"]);
		$i2 = 0; // 2nd counter
		while($i2 < $slot_count){
			$day = $result[$i]['slots'][$i2]['dow'];

			switch($day) {
			 	case 'Monday':
			 	$day = 'MON';
			 	break;
			 
			 	case 'Tuesday':
			 	$day = 'TUE';
			 	break;
			 	
			 	case 'Wednesday':
			 	$day = 'WED';
			 	break;
			 	
			 	case 'Thursday':
			 	$day = 'THU';
			 	break;
			 	
			 	case 'Friday':
			 	$day = 'FRI';
			 	break;
			 	
			 }
			$session = $result[$i]['slots'][$i2]['section'];
			$room = $result[$i]['slots'][$i2]['room'];
			$roomPos = strpos($room, '-');
			$room = substr($room, 0 , $roomPos);
			$current_subject = $result[$i]['name'];
			$current_code = $result[$i]['code'];

			$test_time = $result[$i]['slots'][$i2]['start_time'];
			$pos = strpos($test_time, ':');
			$time_sub = substr($test_time,0,$pos);
			$test_what_M = substr($test_time, $pos+3,2);
			if ($test_what_M == "PM" && $time_sub != 12 ){
				$time_sub = $time_sub + 12 ;
			}
					//print 'name--'.$current_subject.'<br \>';
					//print $session.'<br \>'.'<br \>';
					$timetable[$day][$time_sub]['start_date'] = $result[$i]['slot'][$i2]
					$timetable[$day][$time_sub]['subject']= $current_subject;
					$timetable[$day][$time_sub]['code']= $current_code;
					$timetable[$day][$time_sub]['room']= $room;
					$timetable[$day][$time_sub]['session']= $session;	
					//print $timetable[$day][$time_sub]['subject'].'<br \>';		
			
			$i2++;
		}
		$i++;
	}
	*/

?>