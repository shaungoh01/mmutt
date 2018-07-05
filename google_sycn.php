<?php
	require __DIR__ . '/vendor/autoload.php';
	$dotenv = new Symfony\Component\Dotenv\Dotenv();
	$dotenv->load(__DIR__.'/.env');

	ini_set('display_errors', 1);
	require_once 'Google/Client.php';
	require_once 'Google/Service/Calendar.php';
	require_once 'time_oop.php';

	session_start();

	$redirect = "http://mmutt.sle4ever.com/google_sycn.php";
	$client_id= getenv("GOOGLE_CLIENT_ID");
	$client_secret= getenv("GOOGLE_CLIENT_SECRET");
	$apikey = getenv("GOOGLE_APIKEY");

	$client = new Google_Client;
	$client->setApplicationName("Google Calendar Sycn");
	$client->setClientId($client_id);
	$client->setClientSecret($client_secret);
	$client->setRedirectUri($redirect);
	$client->setDeveloperKey($apikey);

	$cal = new Google_Service_Calendar($client);

	if (isset($_GET['code'])) 
	{
		$client->authenticate($_GET['code']);
		$_SESSION['token'] = $client->getAccessToken();
		header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
		exit();
	}

	if (isset($_SESSION['token'])) 
	{
	$client->setAccessToken($_SESSION['token']);
	}
	if ($client->getAccessToken()) 
	{
		$timetable = json_decode($_SESSION['timetable'],true);

		for($a = 1; $a< 6 ; $a++) {
			switch($a) {
			 	case 1:
			 	$b = 'MON'; 
			 	break;
			 
			 	case 2:
			 	$b = 'TUE';
			 	
			 	break;
			 	
			 	case 3:
			 	$b = 'WED';
			 	break;
			 	
			 	case 4:
			 	$b = 'THU';
			 	break;
			 	
			 	case 5:
			 	$b = 'FRI';
			 	break;
			}
			$i = 8;
			while ($i < 23 ){
				$lenght = 1; 
				if(isset($timetable[$b][$i]['code'])){

				$minute = '00';
				if(isset($timetable[$b][$i]['minute'])){
					$minute = $timetable[$b][$i]['minute'];
				}

				$start_date = $timetable[$b][$i]['start_date'];
				$end_date = $timetable[$b][$i]['end_date'];
				$day = substr($start_date, 0,2);
				$month = substr($start_date, 3,2);
				$year = substr($start_date, 6,4);

				$eday = substr($end_date, 0,2);
				$emonth = substr($end_date, 3,2);
				$eyear = substr($end_date, 6,4);

				$start_date = $year . "-" . $month . "-" . $day;
				$end_date = $eyear . "-" . $emonth . "-" . $eday;
				$start_date1 = str_replace("-", "", $start_date);
				$end_date1 = $eyear . $emonth . $eday;

				$dayofweek = date('w', strtotime($start_date));
				$start_date = date('Y-m-d', strtotime(($a - $dayofweek).' day', strtotime($start_date)));

				echo $start_date1;
				echo $end_date1;
				$lenght = $timetable[$b][$i]['lenght'];
					/*
					$trigger = 0;
					$ib = $i;
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
					$obj = new date_c();
					$i0 = $obj->check_0($i);

					$event = new Google_Service_Calendar_Event();
					$event->setSummary($timetable[$b][$i]['subject'] . " - " .$timetable[$b][$i]['code'] . " [".$timetable[$b][$i]['session'] ."]" );
					$event->setlocation($timetable[$b][$i]['room']);
					$start = new Google_Service_Calendar_EventDateTime();
					$start->setDateTime( $start_date.'T'.$i0.':'.$minute.':00' );
					$start->setTimeZone('Asia/Kuala_Lumpur');
					$event->setStart($start);
					$end = new Google_Service_Calendar_EventDateTime();
					$i = $i + $lenght;
					$i0 = $obj->check_0($i);
					$end->setDateTime( $start_date.'T'.$i0.':'.$minute.':00' );
					$end->setTimeZone('Asia/Kuala_Lumpur');
					$event->setEnd($end);
					$reminder = new Google_Service_Calendar_EventReminders();
					if($_SESSION['method'] == "Default"){

						}else{
							$reminder->setUseDefault(false);
							if($_SESSION['method'] == "None"){

							}else{
									$overrides = array('method' => $_SESSION['method'], "minutes" => $_SESSION['minutes']);
									$reminder->setOverrides(array($overrides));
								}
							$event->setReminders($reminder);
							}
							echo 'RRULE:FREQ=WEEKLY;UNTIL='.$end_date1.'T230000Z;';
					$event->setRecurrence(array('RRULE:FREQ=WEEKLY;UNTIL='.$end_date1.'T230000Z;'));
					$cal->events->insert('primary', $event);

					$_SESSION['token'] = $client->getAccessToken();
				}else{
					$i = $i + $lenght;
				}
			}
			$obj = new date_c();
			$day +=1;
			$day = $obj->check_0($day);
			$start_date = $year . "-" .$month . "-" . $day;
			$start_date = $obj->check_date($start_date);
		}
		$day1 = substr($start_date1, 6,2); 
		$month1 = substr($start_date1, 4,2);
		$year1 = substr($start_date1, 0,4);
		$day1 += 7;
		$day1 = $obj->check_0($day1);
		$start_date1 = $year1 . "-" .$month1 . "-" . $day1;
		$start_date1 = $obj->check_date($start_date1);
		$start_date = $start_date1;
		$start_date1 = str_replace("-", "", $start_date1);
	}
	$_SESSION['timetable'] = json_encode($timetable);

	unset($_SESSION['start_date']);
	unset($_SESSION['end_date']);
	unset($_SESSION['method']);
	unset($_SESSION['minutes']);
	$_SESSION['notification'] = "You had successfully synchronize your MMU Timetable with your Google account.<br /> Please do not synchronize the same thing again to prevent double copy <br /> Refresh this page if you still wan to sync to your Google account";
	header('Location: http://' . $_SERVER['HTTP_HOST'] .'/timetable.php');
	exit();

?>