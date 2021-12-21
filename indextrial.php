<?php
  session_start();

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="icon" href="favvv.ico" />
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Ubuntu:ital,wght@1,500&display=swap" rel="stylesheet">
</head>
<style>
.textt {
  position: absolute;
  bottom: 20px;
  right: 20px;
  color: white;
  padding-bottom: 20px;
  padding-top: 20px;
  margin-right:400px;
  margin-bottom:400px;
  }
  <div class="col-4"></div>
  <div class="col-4 mt-5 text-center">
      <h2><strong>Cooking Recipe Portal</strong></h2>
  </div>
  <div class="col-4"></div><div class="container">
  <div class="row"><a class="btn btn-dark" href="login.php">Let's Get Started</a></div>
</style>
<body>
  <div class="w3-top">
    <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
      <a href="trial.html" class="w3-bar-item w3-button">MyRecipeBook</a>
      <!-- Right-sided navbar links. Hide them on small screens -->
      <div class="w3-right w3-hide-small">
        <a href="index.php" class="w3-bar-item w3-button">Home</a>
        <a href="#about" class="w3-bar-item w3-button">About</a>
        <a href="recipes.php" class="w3-bar-item w3-button">Recipes</a>
        <a href="#contact" class="w3-bar-item w3-button">Contact</a>
    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<a href="profile.php" class="w3-bar-item w3-button"><?php echo $_SESSION['username']; ?></a>
    	 <a href="index.php?logout='1'" class="w3-bar-item w3-button" style="color: red;">Logout</a>
    <?php endif ?>
</div>
</div>
</div>
<header class="w3-display-container w3-content w3-wide " style="max-width:1600px;min-width:500px" id="home">
  <div>
  <img class="mainimage" src="m.jpg" alt="Hamburger Catering" width="1600" height="800" />
  <p class="textt" style="font-weight: bolder;font-size: 30px;font-family:cursive;margin-left:30px">
  <b>Welcome to MyRecipeBook!!<br />MyRecipeBook will help you find all the recipes you want.</b><br />
</p>
  </div>
</header>




<hr />
<div class="w3-content" style="max-width:1100px">
  <!-- About Section -->
  <div class="w3-row w3-padding-64" id="about">
    <div class="w3-col m6 w3-padding-large w3-hide-small">
     <img src="aboutt.jpg" class="w3-round w3-image " alt="Table Setting" width="600" height="950"></div>
    <div class="w3-col m6 w3-padding-large">
      <h1 class="w3-center">About MyRecipeBook</h1><br>
      <h5 class="w3-center">Creat your own magic dish</h5>
      <p>
        MyRecipeBook will help you find recipes.
      </p>
    </div>
</div>
</div>

  <hr>
  <div class="w3-container w3-padding-64" id="contact">
    <h1>Contact Us</h1><br>


</body>
</html>
