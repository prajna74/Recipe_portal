<?php

    session_start();
    require_once "includes/config.php";

    $id = $_GET['id'];
    $current = $_SESSION["id"];


    if($id == 0)
        $id = $current;
    else
        $followed_id = $id;


    $follow_unfollow = "Follow";

    $post_query = "SELECT * FROM `recipe` WHERE `user_id` = $id";
    $query_res = mysqli_query($link, $post_query);
    // $rows = mysqli_fetch_assoc($query_res);


    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST['submit'])) {


            $chek_fl_uf = "SELECT `followed_id` from follow where `follower_id` = $current and `followed_id` = $id";
            $fl_uf_qry = mysqli_query($link, $chek_fl_uf);

            if(mysqli_num_rows($fl_uf_qry) > 0){

            $unfollow_query = "DELETE from follow where `follower_id` = $current and `followed_id` = $id";
            $delete_to_db = mysqli_query($link, $unfollow_query);
            if($delete_to_db) {
                    $follow_unfollow = "Follow";
                echo
                "<script type='text/javascript'>
                    alert('You have successfully unfollowed the user');
                 </script>";
            }

        }else{

            $follow_query = "INSERT INTO `follow` (`follower_id`,`followed_id`) values ($current, $followed_id)";

            $insert_to_db = mysqli_query($link, $follow_query);

            if($insert_to_db) {

                    $follow_unfollow = "Unfollow";
                echo
                "<script type='text/javascript'>
                alert('You have successfully followed the user');

                </script>";
            }
        }
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
    <?php
    include_once 'includes/header.php' ;
    ?>


    <link rel="stylesheet" type="text/css" href="css/styleadmin.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />


</head>
<body style="background-color:#f2a950">

    <?php
    include_once 'includes/profilenavbar.php';
    include_once 'includes/profilesidebar.php'?>



    <div id="main">
    	<div class="row">
    		<?php
            	$sql = "SELECT * FROM `users` WHERE `user_id` = $id";
            	$query = mysqli_query($link, $sql);
            	$result = mysqli_fetch_array($query);


                $sql_follow = "SELECT *, count(*) as count FROM `follow` WHERE `follower_id` = $id";
                $query_follow = mysqli_query($link, $sql_follow);
                $result_follow = mysqli_fetch_array($query_follow);



                $sql_follower = "SELECT *, count(*) as count FROM `follow` WHERE `followed_id` = $id";
                $query_follower = mysqli_query($link, $sql_follower);
                $result_follower = mysqli_fetch_array($query_follower);

                if($id != $_SESSION['id']){
                    $check_follow = "SELECT `follower_id` from follow where `followed_id` = $id and `follower_id` = $current";
                    $check_query = mysqli_query($link, $check_follow);
                    $row = mysqli_num_rows($check_query);
                    if($row > 0){
                        $follow_unfollow = "Unfollow";
                    }
                }
            ?>

    		<div class="col-3">
    			<img src="<?php echo htmlspecialchars($result['user_image_name'] ); ?>" style="border-radius: 100px;" width="200" height="200">
    		</div>

    		<div class="col-9">
    			<div class="d-flex mb-3">
    				<h2><strong><?php echo htmlspecialchars($result['fname'].' '. $result['lname']); ?></strong></h2>

                    <?php
                    if($id == $_SESSION['id']){
                        echo'
    					<a href="editprofile.php?id='.$id.'" id="edit" name="edit" class="btn btn-outline-dark ml-3">Edit Profile</a>';}
                    ?>

    			</div>

				<div class="row">

					<div class="col-3">
						<h5>Posts</h5>
                        <h3><strong><?php echo mysqli_num_rows($query_res); ?></strong></h3>
					</div>

					<div class="col-3">
						<h5>Followers</h5>
                        <h3><strong><?php echo $result_follower['count'] ?></strong></h3>
					</div>

					<div class="col-3">
						<h5>Following</h5>
                        <h3><strong><?php echo $result_follow['count'] ?></strong></h3>
					</div>

				</div>

				<p class="mt-2 bio">
					<?php echo htmlspecialchars($result['description'] ); ?>
				</p>
                <?php
                if($id != $_SESSION['id']){
                        echo'
                <form id="form" method="POST">
                    <input type="hidden" id="id" name="id" value='.$id.'>
                    <input type="hidden" id="current_id" name="cuurent_id" value='.$current.'>
                    <button class="btn btn-primary" type="submit" name="submit" id="submit">'.$follow_unfollow.'</button>
                </form>';
            }?>
    		</div>
    	</div>

    	<div class="row text-center mt-5">
    		<div class="col-12 text-center">
    			<h4><strong>Posts</strong></h4>
    		</div>
    	</div>

    	<div class="row ml-3">

            <?php

                while($rows = mysqli_fetch_assoc($query_res))
                {
                    echo '<div class="col-xs-6 col-md-3 mt-4 text-center">

                            <a href = "details.php?post_id='.$rows['id'].'&user_id='.$id.'">
                                <img src="'.$rows['image_path'].'" width="200" height="200">
                            </a>
                            <p style="overflow: hidden;
                                white-space: normal;
                                height: 2.8em;
                                text-overflow: -o-ellipsis-lastline;
                                ">'.$rows['r_name'].'</p>

                        </div>';
                }

            ?>
            </div>
	</div>
</body>
</html>
