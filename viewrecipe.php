<?php
include('includes/config.php')?>
<!DOCTYPE html>
<html>
<title>View Recipe</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
include_once 'includes/header.php' ?>
<link rel="stylesheet" type="text/css" href="css/styleadmin.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="icon" href="favvv.ico" />
<link rel="stylesheet" href="styles.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&family=Ubuntu:ital,wght@1,500&display=swap" rel="stylesheet">
</head>
</head>
<style>
body,h1,h2,h3,h4,h5,h6
{
  font-family: "Karma", sans-serif
}
.w3-bar-block .w3-bar-item
{
  padding:20px
}
</style>
<body style="background-color:#f2a950">

<!-- Sidebar (hidden by default) -->

<!-- Top menu -->
<?php
include_once 'includes/profilenavbar.php';
include_once 'includes/profilesidebar.php'?>

<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
<div class='w3-row-padding w3-padding-16 w3-center' id='food'>
  <!-- First Photo Grid-->
  <?php

   $s="select *from recipe";
   $r=mysqli_query($link,$s);

   while($a=mysqli_fetch_array($r)){
     $id=$a['user_id'];
     $_SESSION['recipename']=$a['r_name'];
    echo"<div class='w3-quarter'>";
    echo '<a href = "details.php?post_id='.$a['id'].'&user_id='.$id.'">';?>
     <img src="<?php echo htmlspecialchars($a['image_path'] );?>"width=300px height=300px style="padding:20px" /></a>;
<?php
      echo "<h3>".$a['r_name']."</h3>

    </div>";}
    ?>
  </div>
</div>

<script>
// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>

</body>
</html>
