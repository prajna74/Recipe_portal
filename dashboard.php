<?php

session_start();
require_once "includes/config.php";

$current_user = $_SESSION["id"];

$query = "SELECT * FROM recipe where `user_id` in (SELECT `followed_id` from follow where `follower_id` = $current_user)";
$res = mysqli_query($link, $query);
?>
 <DOCTYPE html>
<html>
<head>
	<title>Home</title>
    <?php include_once 'includes/header.php' ?>
    <link rel="stylesheet" type="text/css" href="css/styleadmin.css">
</head>

<body style="background-color:#f2a950;">

    <?php
    include_once 'includes/profilenavbar.php';
    include_once 'includes/profilesidebar.php'?>

    <div id="main">

        <div class="container">

            <?php
                if(mysqli_num_rows($res) > 0){
                    echo  '<h5><b>Feed</b></h5>';
                }else{
                        echo '<a href="search.php?search="" class="btn btn-dark">Find Users</a>';

                }
            ?>
            <div class="row">
                <?php
                    while($rows = mysqli_fetch_assoc($res))
                    {
                        echo '<div class="col-xs-6 col-md-3 mt-4 text-center">

                            <a href = "details.php?post_id='.$rows['id'].'&user_id='.$rows['user_id'].'">
                                <img src="'.$rows['image_path'].'" width="200" height="200">
                            </a>
                            <p style="overflow: hidden;
                                white-space: normal;
                                height: 2.8em;
                                text-overflow: -o-ellipsis-lastline;
                                ">'.$rows['description'].'</p>

                        </div>';
                    }
                ?>

            </div>
        </div>

    </div>

</body>
</html>
