<?php 
session_start();
if(!isset($_SESSION['timetable'])){

header("Location: index.php");
exit;

}
?>
<!DOCTYPE html>
<html>
<head>
<?php include'headerConfig.php' ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<script src="components/webcomponentsjs/webcomponents.js"></script>
	<link rel="import" href="components/paper-button/paper-button.html">
	<link rel="import" href="components/paper-drawer-panel/paper-drawer-panel.html">
	<link rel="import" href="components/iron-icons/iron-icons.html">
	<link rel="import" href="components/paper-menu/paper-menu.html">
	<link rel="import" href="components/paper-item/paper-item.html">
	<link rel="import" href="components/paper-icon-button/paper-icon-button.html">
	<link rel="import" href="components/paper-dialog/paper-dialog.html">
	<link rel="import" href="components/paper-dialog-behavior/paper-dialog-behavior.html">
	<link rel="import" href="components/font-roboto/roboto.html">
	<style type="text/css">
		
	</style>
</head>
<body>
	<paper-drawer-panel responsiveWidth="950px">
		<?php include 'sideBar.php' ?>
				<paper-header-panel main="" flex="" mode="waterfall-tall" tallclass="medium-tall">
				<?php include 'header.php';?>
				<?php
					if(isset($_SESSION['notification'])){
				?>
				<paper-dialog with-backdrop="true" class="syncbox" heading="Notification" transition="paper-dialog-transition-bottom" opened="true">
				<p style="font-family:RobotoDraft,Helvetica,Arial,sans-serif;">
				<?php echo$_SESSION['notification']; ?>
				</p>
				</paper-dialog>
				<?php
					unset($_SESSION['notification']);
					} 
				?>
				<paper-dialog with-backdrop="true" class="syncbox" heading="Google Sync Information" transition="paper-dialog-transition-bottom">
					<br />
					<form action="session_create.php" method="post">
						Reminder by  <select name="method">
										<option value="Default">Default</option>
										<option value="popup" selected="selected">Popup</option>
										<option value="email">Email</option>
										<option value="None">None</option>
									</select>: 
												<select name="minutes">
													<option value="-1">none</option>
													<option value="0">0</option>
													<option value="1">1</option>
													<option value="5">5</option>
													<option value="10" selected="selected">10</option>
													<option value="15">15</option>
													<option value="20">20</option>
													<option value="25">25</option>
													<option value="30">30</option>
												</select>
												Minutes
						<br />
						*if None or Default, ignore the minutes
						<br />
						*Popup is also mean for notification on smartphone
						<br />
						<br />
						<button type="submit" style="background-color: transparent; border:0; border-color: transparent; padding:0;">
						<paper-button raised="" type="submit" style="width:100%;">Submit</paper-button>
						</button>
					</form>
				</paper-dialog>
				<paper-material elevation="2" class="MainCard" style="width:95%; margin-right:auto; margin-left:auto; margin-bottom:30px;">
				<?php include 'main_function.php' ?>
				</paper-material>
				<?php include 'narrowMain_function.php' ?>
			</paper-header-panel>
	</paper-drawer-panel>
</body>
</html>