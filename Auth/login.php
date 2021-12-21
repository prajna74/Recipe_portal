<?php 
	session_start();
	require('../includes/config.php');
	if(isset($_SESSION['status']))
	{
		header("location:index.php");
	}
?>

<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/register/stylelog.css">
	<script type="text/javascript" src="../js/register.js"></script>
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome/css/font-awesome.css">
</head>

<body>

	<?php
		include("../includes/header.php");
	?>

	<div class="wrapper py-5">
		<div class="inner-card">
			<form action="process_login.php" method="POST">
				<h2>Login Here</h2>

				<div class="form-group"> 
				<input type="email" class="form-control" placeholder="Email" name='usernm' required>
				</div>


				<div class="input-group mb-3">
					<input type="password" id="inputPassword1" class="form-control" placeholder=" Password" name='pwd'>
					<div class="input-group-append">
						<span class="input-group-text"><i class="fa fa-eye-slash" id="hideme1" onclick="showLoginPassword('hideme1','inputPassword1')"></i></span>
					</div>
				</div>

				<button type="submit" class="btn btn-dark w-100">LOGIN</button>
				<p class="d-inline">Don't have an account?</p><a class="d-inline ml-2" class="nav-link" href="register.php">Register here</a>
			</form>
		</div>
	</div>
</body>
</html>
