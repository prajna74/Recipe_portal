<?php


session_start();
require_once "includes/config.php";


    $fname = "";
    $lname = "";
    $description = 0;
    $id = $_GET['id'];


if($_SERVER["REQUEST_METHOD"] == "POST"){

    $filename = $_FILES["myimage"]["name"];
    $tempname = $_FILES["myimage"]["tmp_name"];
    $folder = "images/".$filename;


    if (move_uploaded_file($tempname, $folder)) {

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $description = $_POST['description'];

        $insert = "UPDATE `users` SET `fname`= '$fname',`lname`= '$lname',`description`= '$description',`user_image_name`= '$folder' WHERE `user_id` = $id";

        mysqli_query($link, $insert);

        echo "<script type='text/javascript'>
                alert('Profile updated successfully');
        </script>";

    }
    else{
        $msg = "Failed to upload image";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Edit Profile</title>
    <?php
    include_once 'includes/header.php' ?>

    >
    <link rel="stylesheet" type="text/css" href="css/styleadmin.css">

</head>
<body style="background-color:#f2a950;">

    <?php
    include_once 'includes/profilenavbar.php';
    include_once 'includes/profilesidebar.php'?>


    <div id="main">
        <h3 style="padding-top: 40px;" id="boys">Edit Profile</h3>

        <?php
            $sql = "SELECT * FROM `users` WHERE `user_id` = $id";
            $query = mysqli_query($link, $sql);
            $result = mysqli_fetch_array($query);
        ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="container">

                <img src="<?php echo htmlspecialchars($result['user_image_name']); ?>" width = "200" class="mb-5">

                <div class="form-group">

                First name :<br>
                <input type="text"  class="form-control"  name="fname" placeholder="first name" value="<?php echo htmlspecialchars($result['fname']); ?>"required><br>

                Last name :<br>
                <input type="text"  class="form-control"  name="lname" placeholder="last name" value="<?php echo htmlspecialchars($result['lname']); ?>" required><br>

                Phone number :<br>
                <input type="number"  class="form-control"  name="phone" placeholder="phone number" value="<?php echo htmlspecialchars($result['phone_no']); ?>" required disabled><br>

                Email :<br>
                <input type="email"  class="form-control" value="<?php echo htmlspecialchars($result['email']); ?>"  name="email" placeholder="Email" required disabled><br>

                <div class="form-group">
                <label>Change image</label>
                <input type="file" name="myimage" class="form-control"required><br/>
                </div>

                Your bio : <br>
                <textarea cols="50" class="form-control" name="description" rows="5"><?php echo htmlspecialchars($result['description']); ?></textarea>

                <button type="submit" name="submit" class="btn btn-large btn-dark mt-3">Submit</button>
            </div>
        </form>
    </div>

</html>
