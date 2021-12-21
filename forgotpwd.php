<?php
// Start the session
session_start();

$log_err=false;

if(isset($_POST['Submit'])){
    // Include the connection.php to this page
    include("includes/config.php");

//    Get the data from the form
   $email=$_POST['email'];
   $phone=$_POST['phone'];

// Read the session variable
    $_SESSION['email']=$email;

// Check whether the email entered is registered and data entered is proper
   $result = mysqli_query($link,"SELECT * FROM users WHERE email = '$email' and phone_no ='$phone'");
   $row = mysqli_num_rows($result);
   if($row == 0){
    $log_err=true;
      }
    else{
        header("location:resetpwd.php?success");
    }

    // Close the connection
      $link->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <?php include('includes/loginregisternavbar.php');?>
    <link rel="stylesheet" href="css/stylelog.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="background-image:url('images/login.jpg');background-size:cover;">
    <div class="wrapper">
    <div class="inner-card">

       <form action="forgotpwd.php" method="post">
         <div style="margin-top:8%;">
         <label for="email"><b>Email</b>:</label><br>
         <input id="email" class="form-control" name="email" type="email" placeholder="Enter your E-mail">
         </div>

         <div style="margin-top:5%;">
         <label for="phone" class="style"><b>Phone Number:</b></label>
         <input id="phone" class="form-control" name="phone" type="tel" pattern={0-9}[10] placeholder="Enter the phone no.">
        </div>
        <?php
           if($log_err == true){
            echo"<span id='demo1'style='color:red;font-weight:bold;margin-left:15%;margin-top:-7%;'><br>Something went wrong!</span>";
           }
        ?>
        <div style="margin-top:30px;">
            <button type="submit" name="Submit" class="btn btn-primary">Next</button>
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
