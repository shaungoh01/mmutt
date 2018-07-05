<?php 
session_start();
if(!isset($_SESSION['timetable'])){
	header("Location: index.php");
	exit;
}

include 'layout/sidebarLayout/header.php'; 
?>
		<?php include 'layout/sidebarLayout/sideBar.php' ?>
	<div class="container">
		<?php //include 'sideBar.php' ?>
				<div class="card">
					<h1>MMU TimeTable</h1>
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

				<paper-material elevation="2" class="MainCard" style="width:95%; margin-right:auto; margin-left:auto; margin-bottom:30px;">
				<?php include 'main_function.php' ?>
				</paper-material>
				<?php include 'narrowMain_function.php' ?>
			</div>
	</div>
				<div class="modal fade" tabindex="-1" role="dialog" id="copy-to-google-modal">
					<form action="session_create.php" method="post">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Copy To Google</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
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
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary">Submit</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
					
					</form>
				</div>
<?php include 'layout/sidebarLayout/footer.php'; ?>