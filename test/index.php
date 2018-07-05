<?php
ob_start();
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['pwd'])){
			flush();
			header("location: http://MMUTTGC.cu.cc/main_function.php");
			}
?>
<!DOCTYPE html>
<html leng="en">
<head>
<meta charset="UTF-8" />
<title>MMUTTGC - Index</title>	
	<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>	
<body>
	<?php
	ob_start();
	session_start();
	if(isset($_SESSION['error']) && $_SESSION['error'] != ""){
		Echo "ERROR : " . $_SESSION['error'];
	}
	?>
	<form action="main_function.php" method="post">
		<table>
			<tr>
				<td>
					ID:
				</td>
				<td>
					<input type="text" name="id" />
				</td>
			</tr>
			<tr>
				<td>
					Password:
				</td>
				<td>
					<input type="password" name="pwd" />
				</td>
			</tr>
			<tr>
				<td>
					
				</td>
				<td>
					<input type="submit" value="Login"/>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>