<?php 
$test = "/test";
ob_start();
session_start();
if(isset($_SESSION['error'])){
	$_SESSION['error']="";
}
if( $_SERVER['REQUEST_METHOD'] == 'POST'){
	$id = $_POST['id'];
	$id_c = strlen($id);
	if ($id_c != 10){
		$_SESSION['error'] = "ID must have 10 digit";
		flush();
		header("Location: http://mmuttgc.cu.cc".$test."/index.php");
		exit;
	}
$_SESSION['id'] = $_POST['id'];
$_SESSION['pwd'] = $_POST['pwd'];
}

	$vlogin =  "http://mmlsreaderweb.appspot.com/sic.php";
	$ch = curl_init($vlogin);
	curl_setopt( $ch ,CURLOPT_URL, $vlogin );
	curl_setopt( $ch ,CURLOPT_POST , 1);
	curl_setopt($ch ,CURLOPT_FAILONERROR , 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'u='. $_SESSION['id'] .'&p=' . $_SESSION['pwd']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
	$result_json = curl_exec($ch);
	curl_close($ch); 
	$result = json_decode($result_json,true);
	
	$counter = count($result['timetable']);
	if($counter == 0)
	{
		unset($_SESSION['id']);
		unset($_SESSION['pwd']);
		$_SESSION['error'] = "Wrong id or password .. or you just dont have a time table";
		flush();
		header("Location: http://mmuttgc.cu.cc".$test."/index.php");
		exit;
	}
	$i = 0;
	while( $i < $counter ){
		$slot_count = $result['timetable'][$i][slot_count];
		$i2 = 0; // 2nd counter
		while($i2 < $slot_count){
			$day = $result['timetable'][$i][slot][$i2][day];
			$session = $result['timetable'][$i][slot][$i2][session];
			$room = $result['timetable'][$i][slot][$i2][room];
			$current_subject = $result['timetable'][$i][subject];
			$current_code = $result['timetable'][$i][code];
			$test_time = $result['timetable'][$i][slot][$i2][time];
			$time_sub = substr($test_time,0,2);
			$test_what_M = substr($test_time, 12,2);
			if ($test_what_M == "PM" && $time_sub != 12 ){
				$time_sub = $time_sub + 12 ;
			}else if($time_sub < 10){
				$time_sub = substr($time_sub,1,1);
			}
			switch ($day) {
				case 'MON':
					$MON[$time_sub]['subject']= $current_subject;
					$MON[$time_sub]['code']= $current_code;
					$MON[$time_sub]['room']= $room;
					$MON[$time_sub]['session']= $session;
					break;
				
				case 'TUE':
					$TUE[$time_sub]['subject']= $current_subject;
					$TUE[$time_sub]['code']= $current_code;
					$TUE[$time_sub]['room']= $room;
					$TUE[$time_sub]['session']= $session;
					break;
					
				case 'WED':
					$WED[$time_sub]['subject']= $current_subject;
					$WED[$time_sub]['code']= $current_code;
					$WED[$time_sub]['room']= $room;
					$WED[$time_sub]['session']= $session;
					break;
					
				case 'THU':
					$THU[$time_sub]['subject']= $current_subject;
					$THU[$time_sub]['code']= $current_code;
					$THU[$time_sub]['room']= $room;
					$THU[$time_sub]['session']= $session;
					break;
					
				case 'FRI':
					$FRI[$time_sub]['subject']= $current_subject;
					$FRI[$time_sub]['code']= $current_code;
					$FRI[$time_sub]['room']= $room;
					$FRI[$time_sub]['session']= $session;
					break;
				default:
					
					break;
			}
			$i2++;
		}
		$i++;
	}

function test($t_day,$i3){
	if ($t_day[$i3]['subject'] == ""){
		echo "<td style='border:solid; border-width:1px;'></td>";
	}else{
		echo "<td style='border:solid; border-width:1px; text-align:center;'>";
		echo "Subject : " .$t_day[$i3]['code'] ." - ". $t_day[$i3]['subject'] . "<br />";
		echo "Class : " . $t_day[$i3]['room'] . " [" . $t_day[$i3]['session'] . "]";
		echo "</td>";
	}
} 

echo "<table style='border:solid; border-width:1px; border-collapse:collapse;'><tr><td style='border:solid; border-width:1px;'></td><td style='border:solid; border-width:1px;'>Monday</td><td style='border:solid; border-width:1px;'>Tuesday</td><td style='border:solid; border-width:1px;'>Wednesday</td><td style='border:solid; border-width:1px;'>Thrsday</td><td style='border:solid; border-width:1px;'>Friday</td></tr>";
	$i3 = 8; //3 counter for time table output
	while ($i3 <= 22){
		echo "<tr><td style='border:solid; border-width:1px;'>";
		$i3a = $i3 + 1;
		echo $i3." - " .$i3a ;
		echo "</td>"; 	 
	 test($MON, $i3);
	 test($TUE, $i3);
	 test($WED, $i3);
	 test($THU, $i3);
	 test($FRI, $i3);
	 	echo "</tr>";
	$i3++;
}
echo "</table>";
echo"<form action='logout.php'><input type='submit' value='Logout'></form>";
?>