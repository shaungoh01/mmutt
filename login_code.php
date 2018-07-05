<?php
ob_start();
session_start();
$test = "";
if(isset($_SESSION['error'])){
	$_SESSION['error']="";
}
if( $_SERVER['REQUEST_METHOD'] == 'POST'){
	$id = $_POST['id'];
	$id_c = strlen($id);
	if ($id_c != 10){
		$_SESSION['error'] = "ID must have 10 digit";
		header("Location: index.php");
		exit;
	}
$_SESSION['id'] = $_POST['id'];
$_SESSION['pwd'] = $_POST['pwd'];

	$vlogin =  "http://camsys.volzel.net/timetable";
	$ch = curl_init($vlogin);

	curl_setopt($ch ,CURLOPT_URL, $vlogin);
	curl_setopt($ch ,CURLOPT_POST , 1);
	curl_setopt($ch ,CURLOPT_FAILONERROR , 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'username='. urlencode($_SESSION['id']) .'&password=' . urlencode($_SESSION['pwd']));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
	$result_json = curl_exec($ch);
	curl_close($ch); 
	$result = json_decode($result_json,true);
	
	if(isset($result['error']) && $result['error'] == 'Your User ID and/or Password are invalid.')
	{
		unset($_SESSION['id']);
		unset($_SESSION['pwd']);
		$_SESSION['error'] = "Wrong id or password .. or you just dont have a time table";
		header("Location: index.php");
		exit;
	}
	$i = 0;
	$counter = count($result);
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

			$test_Etime = $result[$i]['slots'][$i2]['end_time'];
			$Epos = strpos($test_Etime, ':');
			$Etime_sub = substr($test_Etime,0,$Epos);
			$Etest_what_M = substr($test_Etime, $Epos+3,2);
			if ($Etest_what_M == "PM" && $Etime_sub != 12 ){
				$Etime_sub = $Etime_sub + 12 ;
			}		
					if(substr($test_time, $pos+1,2) == 30){
						$timetable[$day][$time_sub]['minute'] = '30'; 
					}
					$lenght = $Etime_sub - $time_sub;
					//for($x = $time_sub ;  $x < $Etime_sub ; $x++){
					$timetable[$day][$time_sub]['start_date'] = $result[$i]['slots'][$i2]['start_date'];
					$timetable[$day][$time_sub]['end_date'] = $result[$i]['slots'][$i2]['end_date'];
					$timetable[$day][$time_sub]['subject']= $current_subject;
					$timetable[$day][$time_sub]['code']= $current_code;
					$timetable[$day][$time_sub]['room']= $room;
					$timetable[$day][$time_sub]['session']= $session;
					$timetable[$day][$time_sub]['lenght'] = $lenght;
					//}
			$i2++;
		}
		$i++;
	}
	$_SESSION['testArray'] = $result_json;
	$_SESSION['timetable'] = json_encode($timetable);
}

header("Location: timetable.php");
exit;


?>