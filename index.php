<?php
ob_start();
session_start();
if (isset($_SESSION['timetable'])){
	header('Location: timetable.php');
	exit();
}

?>
<!DOCTYPE html>
<html><head>
	<?php include 'headerConfig.php' ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<link rel="import" href="components/font-roboto/roboto.html">
	<link rel="import" href="components/paper-header-panel/paper-header-panel.html">
	<link rel="import" href="components/paper-toolbar/paper-toolbar.html">
	<link rel="import" href="components/paper-material/paper-material.html">
	<title>Home</title>
  <style is="custom-style">
    /* TODO(polyup): For speed, consider reworking these styles with .classes
                     and #ids rather than [attributes].
    */
    [layout] {
      @apply(--layout);
    }
    [layout][vertical] {
      @apply(--layout-vertical);
    }
    [fullbleed] {
      margin: 0;
      height:100vh;
    }
  </style>
  <style shim-shadowdom>
  paper-button.login{
    padding:0;
  }
  paper-button::shadow .button-content {
    padding:0;
  }
  paper-button.login button {
    padding:1em;
    background-color: transparent;
    border-color: transparent;
  }
  paper-button button::-moz-focus-inner {
    border: 0;
  }
</style>
<style type="text/css">
.buttonHide{
	color: #212121;
	background-color: #C5CAE9;
	display: block;
}
@media screen and (max-width: 480px) {
   #logo{
   		display: none;
   }
   .hide{
	width:48%;
	margin-left: 1%;
}
	.buttonHide{
		color: #212121;
		width:100%;
		font-size: 0.8em;
		display: block;
	}
}
</style>
  <!--
      TODO(polyup): unable to infer path to components
      directory. This import path is probably incomplete.
   -->
  <link rel="import" href="components/iron-flex-layout/iron-flex-layout.html">
</head>
<body fullbleed="" layout="" vertical="">
<paper-header-panel main="" flex="" mode="waterfall-tall" tallclass="medium-tall">
	<paper-toolbar class="">
		<span flex="" style="height:64px; ">
			<img id="logo" src="MMUTTLogoG.png" height="64x" style="float:left;">
			<h1 id="title">MMU TimeTable</h1>
		</span>
		<a class="bottom hide" style="color:white;"><paper-button raised="" class="bottom buttonHide">Hackerspace</paper-button></a>
		<a href="http://sle4ever.com" class="bottom hide" style="color:white;"><paper-button raised="" class="bottom buttonHide"  >SLE4ever.com</paper-button></a>
	</paper-toolbar>
				
	<paper-material elevation="3" style="width:80%; margin-right:auto; margin-left:auto; margin-bottom:30px;">
		<h1 class="index_title1">Multimedia University TimeTable</h1>
		<u><h2 class="index_title2">BETA TESTING</h2></u>
		<h2 class="index_title2">Log In</h2>
		<?php
		if(isset($_SESSION['error']) && $_SESSION['error'] != ""){
			Echo "<div class='error'-->ERROR : " . $_SESSION['error']. "";
		}
		?>
		<form action="login_code.php" method="post" class="login_table" id="loginForm">
			<table>
				<tbody><tr>
					<td>
						ID:
					</td>
					<td>
						<input type="text" name="id">
					</td>
				</tr>
				<tr>
					<td>
						Password:
					</td>
					<td>
						<input type="password" name="pwd">
					</td>
				</tr>
				<tr>
					<td>
						
					</td>
					<td>
						<paper-button raised="4" class="login"><button type="submit" form="loginForm" value="Submit" style="width:100%;">Login</button></paper-button>
					</td>
				</tr>
			</tbody></table>
		</form>
	</paper-material>
	</paper-header-panel>

</body></html>
