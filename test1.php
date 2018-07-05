<?php 
//$test = "/test";
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
			
					$timetable[$day][$time_sub]['subject']= $current_subject;
					$timetable[$day][$time_sub]['code']= $current_code;
					$timetable[$day][$time_sub]['room']= $room;
					$timetable[$day][$time_sub]['session']= $session;			
			
			$i2++;
		}
		$i++;
	}

echo "<table style='border:solid; border-width:1px; border-collapse:collapse; margin:0;'><tr><td style='border:solid; border-width:1px;'></td><td style='border:solid; border-width:1px;'>Monday</td><td style='border:solid; border-width:1px;'>Tuesday</td><td style='border:solid; border-width:1px;'>Wednesday</td><td style='border:solid; border-width:1px;'>Thrsday</td><td style='border:solid; border-width:1px;'>Friday</td></tr>";
	$i3 = 8; //3 counter for time table output
	$skip = 0;
	while ($i3 <= 22){
		if($MON[$i3]['code']=="" && $TUE[$i3]['code']=="" && $WED[$i3]['code']=="" && $THU[$i3]['code']=="" && $FRI[$i3]['code']==""){
			$skip++;
			$i3++;
			continue;
		}
		if($skip == 0 ) {
		$border = "solid";
	}	else {
		$border = "double";
	}
echo "<tr><td style='border-top-style:".$border."; border-width:1px; text-align:center; width:10%;'>";
		$i3a = $i3 + 1;
		echo $i3." - " .$i3a ;
		echo "</td>"; 	 
	 	for($a = 0; $a<5 ; $a++) {
			 switch($a) {
			 	case 0:
			 	$b = "MON";
			 	break;
			 
			 	case 1:
			 	$b = "TUE";
			 	break;
			 	
			 	case 2:
			 	$b = "WED";
			 	break;
			 	
			 	case 3:
			 	$b = "THU";
			 	break;
			 	
			 	case 4:
			 	$b = "FRI";
			 	break;
			 	
			 	if ($t_day[$i3]['subject'] == ""){
					echo "<td style='border:".$border."; border-width:1px; width:18%;'></td>";
				}else{ 
					echo "<td style='border:".$border."; border-width:1px; text-align:center; width:18%;'>";
					echo "Subject : " .$timetable[$b][$i3]['code'] ." - ". $timetable[$b][$i3]['subject'] . "<br />";
					echo "Class : " . $timetable[$b][$i3]['room'] . " [" . $timetable[$b][$i3]['session'] . "]";
					echo "</td>";
				}
			 }
		}
	 //output_td($MON, $i3 , $border);
	 
	 	echo "</tr>";
	$i3++;
}
echo "</table>";
?>