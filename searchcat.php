<?php
	session_start();
	require_once "includes/config.php";

	$current = $_SESSION['id'];
  if($_SERVER["REQUEST_METHOD"] == "GET"){
    $search = $_GET['search'];}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Search</title>

	<?php
	include_once 'includes/config.php';
    include_once 'includes/header.php' ?>
    <link rel="stylesheet" type="text/css" href="css/styleadmin.css">

</head>
<body style="background-color:#f2a950">

	<?php
    include_once 'includes/profilenavbar.php';
    include_once 'includes/profilesidebar.php'; ?>

    <div id="main">

    	<?php
            $sql = "SELECT * FROM `recipe`";
            $query = mysqli_query($link, $sql);
            $result=mysqli_fetch_array($query);
        ?>

		<form class="form-group w-25" method="GET">
			<fieldset>
        Choose a category</br>
        <select class="form-control w-50 mb-3" value="<?php if(isset($_GET["search"])) echo $_GET["search"]; ?>" name="search" required>
         <option value="">Choose a Category</option>
        <option value="veg">Veg</option>
        <option value="Non Veg">Non veg</option>
</select>


			<input class="btn btn-success mt-3 px-4 py-1" type="submit" id="x" value="Search" />
			</fieldset>
		</form>

		<div class="row">

			<?php
        if(isset($search)){
        if($search=="veg"){
        $query="select * from `recipe` where cat='$search'";
        $res = mysqli_query($link,$query) or die("Can't Execute Query...");
      }
      if($search=="Non Veg") {
      $query="select * from `recipe` where cat='$search'";
      $res = mysqli_query($link,$query) or die("Can't Execute Query...");
    }
				while($row=mysqli_fetch_assoc($res))
				{
            $id=$row['user_id'];
					echo '
					<div class="col-3 mt-4 text-center">
		    			<img src="'.$row['image_path'].'" height="200" width="200" style="border-radius: 120px;">

		    			<p class="mt-2"><strong>'.$row['r_name'].'</strong>
		    			<p
		    			style="overflow:hidden;
		    			text-overflow: ellipsis;
		    			display: inline-block;
		    			width: 180px;
		    			white-space: nowrap;
		    			overflow: hidden !important;">'.$row['description'].'</p>
		    			<a href = "details.php?post_id='.$row['id'].'&user_id='.$id.'" class="btn btn-primary text-white mt-2 px-4 py-0">View Recipe</a>
		    		</div> ';
    			}
        }
    		?>

    		</div>
		</div>
    </div>

</body>
</html>
