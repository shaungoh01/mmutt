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
				<div class="card" style="padding:20px;">
					<h1>MMU TimeTable</h1>
				<?php
					if(isset($_SESSION['notification'])){
				?>
				<div class="alert alert-primary" role="alert">
				<p style="font-family:RobotoDraft,Helvetica,Arial,sans-serif;">
				<?php echo$_SESSION['notification']; ?>
				</p>
				</div>
				<?php
					unset($_SESSION['notification']);
					} 
				?>
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Weekly View</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Agenda View</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<?php include 'main_function.php' ?>
				</div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<?php include 'narrowMain_function.php' ?></div>
</div>
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
							<br />
							*Becareful if you have already add classes. It will duplicate if you did
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