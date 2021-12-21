<?php
    session_start();
    require_once "includes/config.php";
    $current = $_SESSION['id'];
    $post_id = $_GET['post_id'];
    $sub_up = "Submit";
    $user_id = $_GET['user_id'];

    $avg_rate = 0;

    $temp_rate = 0;
    $temp_rvw = "";

    $sql_name = "SELECT fname, lname, user_id from users where `user_id` = $user_id";
    $query_nm = mysqli_query($link, $sql_name);
    $result_nm = mysqli_fetch_array($query_nm);

    $sql = "SELECT * FROM `recipe` WHERE `id` = $post_id";
    $query = mysqli_query($link, $sql);
    $result = mysqli_fetch_array($query);

    $avg_sql = "SELECT AVG(rating) as avg from post_rating where postid = $post_id";
    $avg_qry = mysqli_query($link, $avg_sql);
    $avgresult = mysqli_fetch_array($avg_qry);
    $avg_rate = $avgresult['avg'];

    $steps_query = "SELECT step_number, step_desc, step_dur FROM `steps` WHERE `recipe_id` = $post_id";
    $steps_query_out = mysqli_query($link, $steps_query);


     $rv="SELECT fname,lname,review from post_rating , users  where `postid`=$post_id and post_rating.`userid` =  users.`user_id`" ;
    $ress=mysqli_query($link,$rv);


    $ingr_qry = "SELECT ingr_name, ingr_qty FROM `ingredients` WHERE `recipe_id` = $post_id";
    $ingr_out = mysqli_query($link, $ingr_qry);

    $check_rv = "SELECT * from post_rating where `userid` = $current and `postid` = $post_id";
    if($check_res = mysqli_query($link, $check_rv)){
        if(mysqli_num_rows($check_res) > 0){
            $sub_up = "Update";
            $result_rv = mysqli_fetch_array($check_res);
            $temp_rate = $result_rv['rating'];
            $temp_rvw = $result_rv['review'];
        }
    }else{
         echo "<script type='text/javascript'>
                alert('Something went wrong !');
        </script>";
    }


    if($_SERVER["REQUEST_METHOD"] == "POST"){

      if(isset($_POST['submit'])) {
            $review = $_POST['review'];
            $rating = $_POST['rating'];
            $add_review = "INSERT INTO post_rating (`userid`, `postid`, `rating`, `review`) values ($current, $post_id, $rating, '$review')";
            if(mysqli_query($link, $add_review)){
                echo "<script type='text/javascript'>
                        alert('Review added successfully ! !');
                      </script>";
            }else{
                echo "<script type='text/javascript'>
                        alert('Something went wrong!');
                    </script>";
            }
      }
    }
?>


<!DOCTYPE html>
<html>
<head>
	<title>Details</title>

	<?php
    include_once 'includes/header.php' ?>


    <link rel="stylesheet" type="text/css" href="css/styleadmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body style="background-color:#f2a950;">

    <?php
    include_once 'includes/profilenavbar.php';
    include_once 'includes/profilesidebar.php'?>




    <div id="main">

        <div class="container">
            <div class="ml-5">
            <h2><b><?php echo htmlspecialchars($result['r_name'] ); ?></b></h2>
            <p><b><i>By : </i></b>

                <?php echo '
                <a href="profile.php?id='.$result_nm['user_id'].'">'.$result_nm['fname'].' '.$result_nm['lname'].'</a></p>';

                if($avg_rate == 0){
                    echo '<p>No ratings yet</p>';
                }else{
                    echo '<p>'.round($avg_rate, 2).' <i class="fa fa-star"></i></p>';
                }
                ?>
            </div>
        </h2>

    	<div class="row p-5">
            <img src="<?php echo htmlspecialchars($result['image_path'] ); ?>" width="300" height=300><br>
    		<p class="mt-3"><?php echo htmlspecialchars($result['description'] ); ?></p>

            <div class="col-lg-12 p-3 mt-5 mb-3 border border-dark">
                <h4 class="mb-3"><b>Steps to be followed</b></h4>

                <?php
                    while($step_res = mysqli_fetch_assoc($steps_query_out))
                    {
                        echo '
                        <h6 class="mt-3"><b>Step : '.$step_res['step_number'].'</b></h6>
                        <p class="ml-4 mt-2">'.$step_res['step_desc'].'</a>';
                    }
                ?>

            </div>
            <div class="col-lg-12 p-3 mt-5 mb-3 border border-dark">
                <h4 class="mb-3"><b>Reviews</b></h4>

                <?php
                    while($r_res = mysqli_fetch_assoc($ress))
                    {
                        echo '
                         <h6 class="mt-3"><b>'.$r_res['fname'].' '.$r_res['lname'].'</b></h6>
                        <p class="ml-4 mt-2">'.$r_res['review'].'</a>';
                    }
                ?>

            </div>




            <div class="col-lg-12 mt-2 border border-dark p-3">

                <h4 class="mb-3"><b>Ingredients used</b></h4>

                <?php
                    $i = 1;
                    while($ingr_res = mysqli_fetch_assoc($ingr_out))
                    {
                        echo '
                        <h6 class="mt-3">'.$i." <b>".$ingr_res['ingr_name'].'</b></h6>
                        <p class="ml-4 mt-2">'.$ingr_res['ingr_qty'].'</a>';
                        $i++;
                    }
                ?>

            </div>

    	</div>

    <!--     <div class="col-md-4 ">

            <div id="rating_div">
                <div class="star-rating">
                    <span class="fa divya fa-star-o" data-rating="1" style="font-size:30px;"></span>
                    <span class="fa fa-star-o" data-rating="2" style="font-size:30px;"></span>
                    <span class="fa fa-star-o" data-rating="3" style="font-size:30px;"></span>
                    <span class="fa fa-star-o" data-rating="4" style="font-size:30px;"></span>
                    <span class="fa fa-star-o" data-rating="5" style="font-size:30px;"></span>
                    <input type="hidden" name="whatever3" class="rating-value" value="1">
                </div>
            </div>
        </div -->
        <?php if(strcmp($current, $user_id) != 0){
            echo '

        <form method="POST" enctype="multipart/form-data">

            <select class="custom-select" name="rating" required>
              <option value="">Rate between 1-5</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>


            <textarea class="form-control mt-3" rows="5" placeholder="Write your review here..." name="review" id="review" required >'.$temp_rvw.'</textarea>
            <br>
            <p><button  class="btn btn-default btn-sm btn-info" name="submit" id="submit">'.$sub_up .'</button></p>
        </form>';
    }
         ?>

    </div>
    </div>
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/index.js"></script>

</body>
</html>
