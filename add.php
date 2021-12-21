<?php


session_start();
require_once "includes/config.php";
$current = $_SESSION['id'];


    $title = "";
    $category = "";
    $duration = "";
    $recipe_max_id = 0;
    // $id = $_SESSION["id"];

    if($_SERVER["REQUEST_METHOD"] == "POST"){

      if(isset($_POST['submit'])) {


        $count = count($_POST["duration"]);

        //Getting post values
        $duration = $_POST["duration"];
        $step_desc = $_POST["step_descrip"];

        //Getting post values
        $ingr_name = $_POST["ingridient_name"];
        $ingr_qty = $_POST["ingridient_qty"];

        // Counting No fo Steps
        $count_ingr = count($ingr_name);

        if($count > 0){

           // echo "<script>alert('Skills inserted successfully');</script>";
        $filename = $_FILES["myimage"]["name"];
        $tempname = $_FILES["myimage"]["tmp_name"];
        $folder = "images/".$filename;

        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder)) {


            $title = $_POST['title'];
            $category = $_POST['category'];
            // $sub_category = $_POST['sub_category'];
            $recipe_dur =  $_POST['duration_recipe'];
            $desc = $_POST['descrip'];

            $insert = "INSERT INTO `recipe`(`prep_time`, `image_path`, `user_id`, `description`, `r_name`,`cat`) VALUES ('$recipe_dur', '$folder', $current, '$desc', '$title','$category')";
            if (mysqli_query($link, $insert)){

              $get_id = "SELECT max(id) as id from recipe";
              $query_res = mysqli_query($link, $get_id);

              if(mysqli_num_rows($query_res) > 0){
                $result = mysqli_fetch_array($query_res);
                $recipe_max_id = $result['id'];
              }else
                $recipe_max_id = 1;


              for($i=0; $i<$count; $i++){
                $r_id = $i + 1;

                // echo $duration[$i];
                if(trim($_POST["duration"][$i] != '') and trim($_POST["step_descrip"][$i] != '')){

                  $sql_query = "INSERT INTO steps(`recipe_id`, `step_number`, `step_desc`, `step_dur`) VALUES ($recipe_max_id, $r_id,'$step_desc[$i]', '$duration[$i]')";

                  $sql = mysqli_query($link, $sql_query);
                }
            }
            if($sql){

                    for($i=0; $i<$count_ingr; $i++){
                      $r_id = $i + 1;

                      // echo $duration[$i];
                      if(trim($_POST["ingridient_name"][$i] != '') and trim($_POST["ingridient_qty"][$i] != '')){

                        $sql_query_ingr = "INSERT INTO `ingredients`(`ingr_name`, `ingr_qty`, `recipe_id`) VALUES ('$ingr_name[$i]','$ingr_qty[$i]',$recipe_max_id)";
                        $sql_ingr = mysqli_query($link, $sql_query_ingr);
                      }
                  }

                              if($sql_ingr){
                                echo "<script type='text/javascript'>
                                alert('Recipe added successfully !');
                              </script>";
                              }else{
                                echo "<script type='text/javascript'>
                                      alert('Something went wrong here!');
                                      echo $sql_ingr;
                                    </script>";
                              }


            }else{
              echo "<script type='text/javascript'>
                    alert('Something went wrong here!');
                  </script>";
            }

            }else{
              echo "<script type='text/javascript'>
                    alert('Something went wrong here!');
                  </script>";
            }
        }
        else{

            echo "<script>alert('Failed to upload image');</script>";
        }
      }
        else
          echo "<script>alert('Please enter atleast one step');</script>";
      }
    }

?>

<!DOCTYPE html>
<html>
<head>

    <title>Add new Recipe</title>
    <?php
    include_once 'includes/header.php' ?>

    <!--Custom css-->
    <link rel="stylesheet" type="text/css" href="css/styleadmin.css">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


</head>
<body style="background-color:#f2a950">

    <!--creating navbar-->

    <?php
    include_once 'includes/profilenavbar.php';
    include_once 'includes/profilesidebar.php'?>



    <div id="main">
        <h3 style="padding-top: 40px;" id="boys">Add new Recipe</h3>

        <form method="POST" enctype="multipart/form-data">
            <div class="container">
                <div class="form-group">
                
                Title:<br>
                <input type="text" class="form-control" value="<?php if(isset($_POST["title"])) echo $_POST["title"]; ?>"  name="title" placeholder="give a name to your recipe" ><br>
                Select Category:<br>

                <select class="form-control w-50 mb-3" value="<?php if(isset($_POST["category"])) echo $_POST["category"]; ?>" name="category" required>

                <option value="veg">Veg</option>
                <option value="Non Veg">Non veg</option>
    </select>



                Time required to prepare:<br>
                <input type="text" value="<?php if(isset($_POST["duration_recipe"])) echo $_POST["duration_recipe"]; ?>" class="form-control" name="duration_recipe" placeholder="in minutes"><br>

                <div class="form-group">
                <label>Upload image</label>
                <input value="<?php if(isset($_POST["myimage"])) echo $_POST["myimage"]; ?>" type="file" name="myimage" class="form-control" ><br/>
                </div>

                Write a brief description about the recipe:<br>
                <textarea cols="50" value="<?php if(isset($_POST["descrip"])) echo $_POST["descrip"]; ?>" class="form-control" name="descrip" rows="5" required></textarea>

                <br>Enter the preparation steps

                <!-- <div class="table-responsive">
                    <table class="table table-bordered" id="dynamic_field">
                        <tr>
                        <td>
                          <input type="number" name="duration[]" placeholder="Duration in minutes" class="form-control name_list" />

                          <textarea placeholder="Explain the steps" cols="30" name="step_descrip[]" class="form-control name_list mt-3"></textarea>
                        </td>

                        <td>
                          <button type="button" name="add" id="add" class="btn btn-success">Add More Steps</button>
                        </td>
                        </tr>
                    </table>
                </div>

                <br><b>Add Ingridients

                <div class="table-responsive">
                    <table class="table" id="dynamic_field_2">
                        <tr>
                            <td>
                              <input type="text" name="ingridient_name[]" placeholder="Enter name" class="form-control name_list" required />
                              <input type="text" name="ingridient_qty[]" placeholder="Quantity required" class="form-control name_list mt-3" required/>
                            </td>

                            <td>
                              <button type="button" name="add" id="add_ingr" class="btn btn-success">Add More Ingridients</button>
                            </td>
                        </tr>
                    </table>
                </div> -->

                <div class="container custom-container mt-3">
                    <div class="row border p-3" id="custom">
                        <div class="col-lg-8">
                            <input type="number" name="duration[]" placeholder="Duration in minutes" class="form-control name_list" />

                            <textarea placeholder="Explain the steps" cols="30" name="step_descrip[]" class="form-control name_list mt-3"></textarea>
                        </div>

                        <div class="col-lg-4">
                            <button type="button" name="add" id="add_ingridients" class="btn btn-success mt-3">Add More Steps</button>
                        </div>
                    </div>
                </div>

                <br>Enter the Ingredients required

                <div class="container custom-container_2 mt-3">
                    <div class="row border p-3" id="custom">
                        <div class="col-lg-8">
                            <input type="text" name="ingridient_name[]" placeholder="Enter name" class="form-control name_list" required />

                            <input type="text" name="ingridient_qty[]" placeholder="Quantity required" class="form-control name_list mt-3" required/>
                        </div>

                        <div class="col-lg-4">
                          <button type="button" name="add" id="add_ingridients_2" class="btn btn-success mt-3">Add More Ingridients</button>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" name="submit" id="submit" class="btn btn-large btn-dark mt-3">Submit</button>

        </form>
    </div>
    <!--Main body ends-->

    <script>
$(document).ready(function(){
var j =1;
var k = 1;
// $('#add').click(function(){
// i++;
// $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="duration[]" placeholder="Duration in minutes" class="form-control name_list" /><textarea cols="30" name="step_descrip[]" class="form-control name_list mt-3" placeholder="Explain the steps"></textarea></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
// });

// $('#add_ingr').click(function(){
// j++;
// $('#dynamic_field_2').append('<tr id="row_2'+j+'"><td><input type="text" name="ingridient_name[]" placeholder="Enter name" class="form-control name_list" /><input type="text" name="ingridient_qty[]" placeholder="Quantity required" class="form-control name_list mt-3" /><td><button type="button" name="remove" id="'+j+'" class="btn btn-danger btn_remove_2">X</button></td></tr>');
// });

$('#add_ingridients').click(function(){
k++;
$('.custom-container').append('<div class="row border p-3" id="custom'+j+'"><div class="col-lg-8"><input type="text" name="duration[]" placeholder="Enter duration" class="form-control name_list" required /><input type="text" name="step_descrip[]" placeholder="Explain the steps" class="form-control name_list mt-3" required/></div><div class="col-lg-4"><button type="button" name="remove" id="'+j+'" class="btn btn-danger mt-3 btn_remove">X</button></div></div>');
});


$('#add_ingridients_2').click(function(){
k++;
$('.custom-container_2').append('<div class="row border p-3" id="custom2'+k+'"><div class="col-lg-8"><input type="text" name="ingridient_name[]" placeholder="Enter name" class="form-control name_list" required /><input type="text" name="ingridient_qty[]" placeholder="Quantity required" class="form-control name_list mt-3" required/></div><div class="col-lg-4"><button type="button" name="remove" id="'+k+'" class="btn btn-danger mt-3 btn_remove_2">X</button></div></div>');
});


$(document).on('click', '.btn_remove', function(){
var button_id = $(this).attr("id");
$('#custom'+button_id+'').remove();
});

$(document).on('click', '.btn_remove_2', function(){
var button_id = $(this).attr("id");
$('#custom2'+button_id+'').remove();
});

});
</script>


</html>
