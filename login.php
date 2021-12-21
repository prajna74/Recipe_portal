  <?php

session_start();


if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: dashboard");
    exit;
}

require_once "includes/config.php";


$email = $password = "";
$email_err = $password_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["email"]))){
        $username_err = "Please enter your email.";
    } else{
        $email = trim($_POST["email"]);
    }


    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }


    if(empty($email_err) && empty($password_err)){

        $sql = "SELECT user_id, email, user_pass FROM `users` WHERE `email` = '$email'";
        $query = mysqli_query($link, $sql);
        $result=mysqli_fetch_array($query);

        if($result > 0){
        if ($password == $result['user_pass']) {


            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $result['user_id'];
            $_SESSION['full_name'] = $result['fname'].' '.$result['lname'];

            header("location: dashboard.php");
        } else{

            $password_err = "The password you entered was not valid.";
        }
    }
    else{
        $password_err = "Account does not exists";
    }
    }


    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login Form</title>
        <?php
        include_once 'includes/header.php'
        ?>


        <link rel="stylesheet" href="css/stylelog.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>
    <style>

    </style>
    <body style="background-image: url('images/login.jpg');-webkit-background-size:cover;">


        <?php
        include_once 'includes/loginregisternavbar.php'; ?>

        <div class="wrapper">
            <div class="inner-card">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <h2>Login</h2>

                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <input type="email" name="email" class="form-control" placeholder="Username" required value="<?php echo htmlspecialchars($email);?>">
                        <p class="help-block text-danger mb-1 text-center"><?php echo $email_err; ?></p>
                    </div>

                    <div class="input-group mb-3 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <input type="password" required name="password" id="inputPassword" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                        <span class="input-group-text"><i  id="hideme" class="fa fa-eye-slash" onclick="showLoginPassword('hideme', 'inputPassword')"></i></span>
                        </div>
                    </div>
                    <p class="help-block text-danger mb-1 text-center"><?php echo $password_err; ?></p>                    <button type="submit" class="btn btn-dark">Login</button>
                                    <a href="register.php" class="text-dark">Dont have an account ? Register Here</a>
<a href="forgotpwd.php">Forgot password</a>
                </form>
            </div>
        </div>

    </body>
</html>
