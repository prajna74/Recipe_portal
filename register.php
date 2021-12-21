<?php
// Initialize the session
session_start();

require_once "includes/config.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){

$conpass = trim($_POST['confirm_password']);
$password = trim($_POST["password"]);
$pas =  password_hash($password, PASSWORD_DEFAULT);
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phone = trim($_POST['phone']);
$email = $_POST['email'];
$bio = $_POST['bio'];

if (strlen($password) < 6) {

    echo "<script type='text/javascript'>
            alert('Password must have atleast 6 characters');
          </script>";
}else if(strcmp($conpass, $password) != 0){
        echo"<script type='text/javascript'>
                alert('Passwords didn't match);
            </script>";
}
else if(strlen($phone) != 10){
echo "<script type='text/javascript'>
            alert('Phone number must have 10 digit');
      </script>";
}
    else{

    $ret = mysqli_query($link, "select `user_id` from `users` where `email`='$email' ");
    $result=mysqli_fetch_array($ret);

    $ret1 = mysqli_query($link, "select `user_id` from `users` where `phone_no`='$phone' ");
    $result1 = mysqli_fetch_array($ret1);

    if($result>0){
        echo "<script type='text/javascript'>
                alert('This Email is  associated with another account');
              </script>";

    }else if ($result1 > 0){
        echo "<script type='text/javascript'>
                alert('This number is  associated with another account');
              </script>";

    }
    else{
        password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `users`(`fname`, `lname`, `phone_no`, `email`, `description`, `user_pass`) VALUES ('$fname','$lname',$phone,'$email','$bio','$password');";

        if(mysqli_query($link, $sql)){

            echo "<script type='text/javascript'>
                    alert('Registered successfully ! Please login');
                    window.location.href='login.php';
                    </script>";

          } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
    mysqli_close($link);
}

}
?>
<!DOCTYPE html>
<html>
<head>

    <title>Registration Form</title>

    <?php
    include_once 'includes/header.php' ?>

    <link rel="stylesheet" href="css/stylelog.css">
</head>
<body style="background-image: url('images/register.jpg')">

    <?php
        include_once 'includes/loginregisternavbar.php'; ?>

    <div class="wrapper">
        <div class="inner-card">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2>Register Here</h2>

                <div class="form-group">
                    <input type="text" required name="fname" class="form-control" placeholder="First name" required value="<?php if(isset($fname)) echo htmlspecialchars($fname);?>">
                </div>

                <div class="form-group">
                    <input type="text" required name="lname" class="form-control" placeholder="Last name" value="<?php if(isset($lname)) echo htmlspecialchars($lname);?>">
                </div>

                <div class="form-group">
                <input type="email" required name="email" class="form-control" placeholder="Email" value="<?php if(isset($email)) echo htmlspecialchars($email);?>">
                </div>

                <div class="form-group">
                <input type="number" required name="phone" class="form-control" placeholder="Phone number" value="<?php if(isset($phone)) echo htmlspecialchars($phone);?>">
                </div>

                <div class="form-group">
                <textarea cols="30" required class="form-control" name="bio" placeholder="Your bio" rows="5"><?php if(isset($bio)) echo htmlspecialchars($bio)?></textarea>
            </div>

                <div class="input-group mb-3 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <input type="password" required name="password" id="inputPassword" class="form-control" placeholder="Password">

                    <div class="input-group-append">
                        <span class="input-group-text">
                        <i class="fa fa-eye-slash" id="hideme" onclick="showLoginPassword('hideme','inputPassword')" ></i></span>
                    </div>

                </div>
                <span class="help-block"></span>

                <div class="input-group mb-3">
                    <input type="password" required id="inputPassword1" name="confirm_password" class="form-control" placeholder="Confirm Password">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-eye-slash" id="hideme1" onclick="showLoginPassword('hideme1','inputPassword1')"></i></span>
                        </div>
                </div>
                <span class="help-block"></span>
                <button type="submit" class="btn btn-dark">Register</button>
                <a href="login.php" class="text-dark">Already have an account ? Login Here</a>
            </form>
        </div>
    </div>
    <<script type="text/javascript" src="bootstrap\js\jQuery.js"></script>
    <script type="text/javascript" src="bootstrap\js\bootstrap.bundle.js"></script>
    <script type="text/javascript" src="bootstrap\js\bootstrap.js"></script>
    <script type="text/javascript" src="js/register.js"></script>
</body>
</html>
