<?php
	//$test = "/test";
	ob_start();
	session_start();
	if(isset($_SESSION['id']))
	{
		unset($_SESSION['id']);
		unset($_SESSION['pwd']);
		unset($_SESSION['timetable'])
		//if(isset($_COOKIE['userid']))
	//	{
	//		setrawcookie("userid", "" ,time() -3600) ;
	//	}
		flush();
		header("Location: http://mmuttgc.cu.cc".$test."/index.php");
		exit;
	}
?>