<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<title>Material Index</title>
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<script src="components/platform/platform.js"></script>
	<link rel="import" href="components/paper-button/paper-button.html">
	<link rel="import" href="components/core-toolbar/core-toolbar.html">
	<link rel="import" href="components/core-drawer-panel/core-drawer-panel.html">
	<link rel="import" href="components/core-icons/core-icons.html">
	<link rel="import" href="components/core-menu/core-menu.html">
	<link rel="import" href="components/paper-item/paper-item.html">
	<link rel="import" href="components/core-header-panel/core-header-panel.html">
	<link rel="import" href="components/paper-icon-button/paper-icon-button.html">
	<link rel="import" href="components/paper-dialog/paper-dialog.html">
	<link rel="import" href="components/paper-dialog/paper-dialog-transition.html">
	<link rel="import" href="../components/font-roboto/roboto.html">
	<link rel="import" href="components/paper-shadow/paper-shadow.html">
	<style type="text/css">
		
	</style>
</head>
<body>
	<core-drawer-panel>
		<?php include 'sideBar.php' ?>
			<core-header-panel main flex mode="waterfall-tall" tallClass="medium-tall">
				<?php include 'testHeader.php';?>
				<paper-dialog backdrop="true" class="syncbox" heading="Google Sync Information" transition="paper-dialog-transition-bottom">
					<br />
					<form action="session_create.php" method="post">
						Reminder by  <select name="method">
										<option value="Default">Default</option>
										<option value="popup">Popup</option>
										<option value="email">Email</option>
										<option value="None">None</option>
									</select>: 
												<select name="minutes">
													<option value="-1">none</option>
													<option value="0">0</option>
													<option value="1">1</option>
													<option value="5">5</option>
													<option value="10">10</option>
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
						<paper-button raised type="submit" style="width:100%;">Submit</paper-button>
						</button>
					</form>
				</paper-dialog>
				<paper-shadow z="2" style="width:95%; margin-right:auto; margin-left:auto; margin-bottom:30px;">
				<?php include 'main_function.php' ?>
				</paper-shadow>
			</core-header-panel>
	</core-drawer-panel>
</body>
</html>