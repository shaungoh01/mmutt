<?php


ini_set('display_errors', 1);
	require_once 'Google/Client.php';
	require_once 'Google/Service/Calendar.php';
	require_once 'time_oop.php';

	session_start();

	$redirect = "http://mmuttgc.cu.cc/test2.php";
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

					$event = new Google_Service_Calendar_Event();
					$event->setSummary("Testing");
					$event->setlocation("testing");
					$start = new Google_Service_Calendar_EventDateTime();
					$start->setDateTime('2014-04-05T10:00:00' );
					$start->setTimeZone('Asia/Kuala_Lumpur');
					$event->setStart($start);
					$end = new Google_Service_Calendar_EventDateTime();
					$end->setDateTime( '2014-04-05T11:00:00');
					$end->setTimeZone('Asia/Kuala_Lumpur');
					$event->setEnd($end);
					$event->setRecurrence(array("RRULE:FREQ=WEEKLY;UNTIL=20140415T100000-07:00")); 
					$cal->events->insert('primary', $event);

					$_SESSION['token'] = $client->getAccessToken();
?>