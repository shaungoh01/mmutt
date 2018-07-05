<?php
	require __DIR__ . '/vendor/autoload.php';
	$dotenv = new Symfony\Component\Dotenv\Dotenv();
	$dotenv->load(__DIR__.'/.env');

	ini_set('display_errors', 1);
	session_start();
	$_SESSION['method'] = $_POST['method'];
	$_SESSION['minutes'] = $_POST['minutes'];

	$error1 = 0;


	if($error1 == 0){
	switch ($_SESSION['method']) {
		case 'Default':
		case 'None';
			$_SESSION['minutes'] = "-1";
			break;
		
		case 'popup';
		case 'email';
			if ($_SESSION['minutes'] == "-1") {
				$error1 = 1;
			}
			break;
		}
	}

	if ($error1 == 1){
		$_SESSION['notification'] = "ERROR : Wrong Input (Refresh this page to continue)";
		unset($_SESSION['method']);
		unset($_SESSION['minutes']);
		header('Location: http://' . $_SERVER['HTTP_HOST'] .'/timetable.php');
		exit();

	}



	$scope = "https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fcalendar";
	$redirect = "https://mmutt.sle4ever.com/google_sycn.php";
	$client_id= getenv("GOOGLE_CLIENT_ID"); 

	header('Location: https://accounts.google.com/o/oauth2/auth?scope='. $scope .'&redirect_uri=' . $redirect. '&response_type=code&client_id='.$client_id.'&approval_prompt=force');
	exit();

?>