<?php
    //starting the session
    session_start();

    $pass_err=false;
    $reset=false;
    if(isset($_POST['Submit'])){
        //include connedtion.php file to this page
        include("includes/config.php");

    //reading the session variable
    $email=$_SESSION['email'];

    // obtaining the data from the form
    $password=$_POST['password'];
    $confirmpass=$_POST['confirmpassword'];

  // check whether password and confirm password are same or not
    if($password!=$confirmpass){
           $pass_err=true;
    }

    //if data entered is valid update the password
    if($pass_err == false){
    $sql=mysqli_query($link,"UPDATE users SET user_pass='$password' WHERE email='$email'");
      if($sql == true){
             $reset=true;
           header("location:login.php?success");
        }
       else{
           header("location:resetpwd.php?error");
       }
    }
    //close the session
    // session_destroy();

    //close the connection
    $link->close();
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/stylelog.css" />
    <?php include('includes/loginregisternavbar.php');?>
</head>
<body style="background-image:url('login.jpg');background-size:cover;">
<div class="wrapper">

        <div class="inner-card" style="color:black;font-size: 20px;">
            <form class="mtop" action="resetpwd.php" method="POST">
                <h4 class="rtop">Reset Password</h4>
                <div class="form-group">
                <label for="password" class="newleft"><b>New Password:</b></label>
                <input type="password" class="form-control" id="password" placeholder="New Password" name="password" required>
                </div>

                <div class="form-group">
                <label for="confirmpassword" class="passleft"><b>Confirm Password:</b></label>
                    <input type="password" class="form-control" placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" required>
                </div>
                <?php
                    if($pass_err == true){
                        echo"<span style='color:red;font-weight:bold;margin-left:-75px';>Password and Confirmpassword doesn't match</span>";
                    }
                ?>
                <div>
                    <button type="submit" name="Submit" class="btn btn-primary">Reset</button>
                </div>
            </form>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
    crossorigin="anonymous"></script>
</body>
</html>
