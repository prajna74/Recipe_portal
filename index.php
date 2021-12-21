<!DOCTYPE html>
<html>
<head>
<title>Cooking Recipe Portal | HomePage</title>
    <?php
    include_once 'includes/header.php' ?>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<style>
.content {
  position: relative;
}

.topleft {
  position: absolute;
  top: 8px;
  left: 16px;
  font-size: 18px;
  color: white;
}
</style>
<body style="background-color:#f2a950;overflow-x: hidden;";>

    <nav style="background-color: #000; box-shadow: 0px 0px 30px -10px rgba(0,0,0,0.57);" class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand text-white" href="#"><strong>MyRecipeBook</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars text-dark"></i>
        </button>
        <div style="margin-right: 100px;cursor: pointer;" class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link text-white" href="login.php">Login</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-white" href="#about">About</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-white" href="#contact">Contact</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-white" href="logout.php">Logout</a>
                </li>

            </ul>
        </div>
    </nav>

         <div class="header">
           <div class="content">

        <img src="images/m.jpg" width="1800" height="800">
          <div class="topleft">
          <p class="textt" style="font-weight: bolder;font-size: 30px;font-family:cursive;margin-left:30px">
          <b>Welcome to MyRecipeBook!!<br />MyRecipeBook will help you find all the recipes you want.</b><br />
        </p></div>
      </div>
      </div>
      <hr />
      <div class="w3-content" style="max-width:1100px">
        <!-- About Section -->
        <div class="w3-row w3-padding-64" id="about">
          <div class="w3-col m6 w3-padding-large w3-hide-small">
           <img src="images/aboutt.jpg" class="w3-round w3-image " alt="Table Setting" width="600" height="950"></div>
          <div class="w3-col m6 w3-padding-large">
            <h1 class="w3-center">About MyRecipeBook</h1><br>
            <h5 class="w3-center">Creat your own magic dish</h5>
            <p>
              Wondering how to impres your loved ones? Food is the key to happiness.</br>
              Cook a great dish and bring a smile on their family.</br>
              MyRecipeBook will help you find recipes and follow the people you like.</br>
              Create your own profile and share your magic recipe with others.
            </p>
          </div>
      </div>
      </div>

        <hr>
        <div class="w3-content" style="max-width:1100px">
            <div class="w3-row w3-padding-64" id="contact">
          <div class="row">
            <div class="col-md-4">
              <h4>MyRecipeBook</h4>
              <p>
                 <b>Happy cooking!!!<br />
                 Visit Again</b>
              </p>

            </div>
            <div class="col-md-4">
              <h4>Quick contact</h4>
              <p>
                <a href="tel:9480558411">
                <i class="fa fa-phone"> <span></span> Call us</i>
              </a>
              </p>
              <p>
                <a href="https://mail.google.com">
                <i class="fa fa-envelope"><span></span> Drop a mail</i>
              </a>
              </p>
            </div>
            <div class="col-md-4">
              <h4>Follow us</h4>
              <p>
                <a href="https://www.instagram.com/">
                <i class="fa fa-instagram"><span>  </span>Instagram</i>
              </a>
              </p>
              <p>
                <a href="https://www.facebook.com/">
               <i class="fa fa-facebook"> <span>  </span>Facebook</i>
              </p>
              </a>
            </div>
          </div>
        </div>
        </div>
</body>
</html>
