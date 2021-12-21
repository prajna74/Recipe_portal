
<?php session_start(); 
require('../includes/config.php');
if(isset($_SESSION['status']))
{
	header("location:index.php");
}
$msg = $name_err = $username_err = $password_err = $contact_err = $city_err = $gender_err = $email_err = "" ;
if($_SERVER["REQUEST_METHOD"] == "POST")
	{

		// $fnm=$_POST['fnm'];
		// $unm=$_POST['unm'];
		// $pwd=$_POST['pwd'];
		// $gender=$_POST['gender'];
		// $email=$_POST['mail'];
		// $contact=$_POST['contact'];
		// $city=$_POST['city'];

		// Check if Username is empty
		if(empty(trim($_POST["fnm"]))){
        $name_err = "Please enter Firstame.";
	    } 
	    else{
	    	if (is_numeric($_POST['fnm'])) {
	    		$name_err = "Name must be in string format";
	    	}
	        $fnm = trim($_POST["fnm"]);
	    }

		// Check if Username is empty
		if(empty(trim($_POST["unm"]))){
        $username_err = "Please enter username.";
	    } else{
	    	$unm = trim($_POST["unm"]);
	    	$ret=mysqli_query($conn, "select `u_id` from `user` where `u_unm`='$unm'");
	    	$result=mysqli_fetch_array($ret);
	    	if($result>0){
	        echo "<script type='text/javascript'>
	                alert('This username is already taken!');
	              </script>";
	    		}
	    	else
	        	$unm = trim($_POST["unm"]);
	    }

	    // Check gender field
	    if(empty(trim($_POST["gender"]))){
        $gender_err = "Please select your gender";
	    } else{
	        $gender = trim($_POST["gender"]);
	    }

	    //Check contact field
	    if(empty(trim($_POST["contact"]))){
        $contact_err = "Please enter your contact number";
	    } else{
	    	$contact = trim($_POST["contact"]);
	    	$ret=mysqli_query($conn, "select `u_id` from `user` where `u_contact`='$contact' ");
		    $result=mysqli_fetch_array($ret);
		    if($result>0){
		        $contact_err = "This number is already registered";
		        }
		    else
        		$contact = trim($_POST["contact"]);
	    }

	    // Check city field
	    if(empty(trim($_POST["city"]))){
        $city_err = "Please select your city";
	    } else{
	        $city = trim($_POST["city"]);
	    }

	    // Check if email is empty
	    if(empty(trim($_POST["mail"]))){
        $email_err = "Please enter your email.";
	    } else{
	    		$email = trim($_POST["mail"]);
	    		$ret=mysqli_query($conn, "select `u_id` from `user` where `u_email`='$email' ");
			    $result=mysqli_fetch_array($ret);
			    if($result>0){
			        echo "<script type='text/javascript'>
			                alert('This email is  associated with another account');
			              </script>";
			              // $msg="This email  associated with another account";
			          }
			    else
	        		$email = trim($_POST["mail"]);
	    }

	    // Check if password is empty
	    if(empty(trim($_POST["pwd"]))){
	        $password_err = "Please enter your password.";
	    } 
	    else{
	    	if (strlen($_POST['pwd'])>10) {
	    		$password_err = "Password should be less than 10 characters.";
	    	}
	    	else if ($_POST['pwd']!=$_POST['cpwd']) {
	    		# code...
	    		$password_err = "Passwords did not match";
	    	}
	    	else
	        	$pwd = trim($_POST["pwd"]);
	    }
// $name_err = $username_err = $password_err = $contact_err = $city_err = $email_err
		if(empty($username_err) && empty($name_err) && empty($password_err) && empty($contact_err) && empty($city_err) && empty($email_err))
		{
	
			$query="insert into user(u_fnm,u_unm,u_pwd,u_gender,u_email,u_contact,u_city)
			values('$fnm','$unm','$pwd','$gender','$email','$contact','$city')";
			
			if(mysqli_query($conn,$query)){
			  echo "<script type='text/javascript'> 
		      alert('Registered successfully .'); 
		      window.location.href = 'login.php';
     		      </script>";
			}
else{
  echo "<script type='text/javascript'> 
      alert('Something went wrong please try again .'); 
      window.location.href = 'register.php';
      </script>";
}
		}
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
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
				<h2>Register</h2>

				<div class="form-group"> 
				<input type="text" class="form-control" placeholder="First name" name='fnm' required>
				<span class="help-block text-danger"><?php echo $name_err; ?></span>
				</div>

				<div class="form-group"> 
				<input type="text" class="form-control" placeholder="Last name" name='unm' required>
				<span class="help-block text-danger"><?php echo $username_err; ?></span>
				</div>

				<div class="form-group">
					<input type="email" class="form-control" placeholder="E Mail" name="mail" required>
					<span class="help-block text-danger"><?php echo $email_err; ?></span>
				</div>

				<div class="form-group">
					<input type="number" class="form-control" placeholder="Contact number" name="contact" required>
					<span class="help-block text-danger"><?php echo $contact_err; ?></span>
				</div>

				


				<div class="input-group my-3">
					<input type="password" id="inputPassword" class="form-control" placeholder="Password(Max 10 character)" name='pwd'>
					<div class="input-group-append">
						<span class="input-group-text">
						<i class="fa fa-eye-slash" id="hideme" onclick="showLoginPassword('hideme','inputPassword')" ></i></span>
					</div>
					
				</div>
				<span class="help-block text-danger"><?php echo $password_err; ?></span>
				<div class="input-group mb-3">
					<input type="password" id="inputPassword1" class="form-control" placeholder="Confirm Password" name='cpwd'>
					<div class="input-group-append">
						<span class="input-group-text"><i class="fa fa-eye-slash" id="hideme1" onclick="showLoginPassword('hideme1','inputPassword1')"></i></span>
					</div>
				</div>

				<button type="submit" class="btn btn-dark w-100">Register</button>
				<p class="d-inline">Already have an account?</p><a class="d-inline ml-2" class="nav-link text-dark" href="login.php">Login here</a>
			</form>
		</div>
	</div>
</body>
</html>
		