<?php
	//$test = "/test";//
	ob_start();
	session_start();
	if(isset($_SESSION['timetable']))
	{
		unset($_SESSION['id']);
		unset($_SESSION['pwd']);
		unset($_SESSION['timetable']);
		//if(isset($_COOKIE['userid']))
	//	{
	//		setrawcookie("userid", "" ,time() -3600) ;
	//	}//
		header("Location: index.php");
		exit;
	}
?>