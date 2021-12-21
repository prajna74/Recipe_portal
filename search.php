<?php
	session_start();
	require_once "includes/config.php";

	$current = $_SESSION['id'];


	if($_SERVER["REQUEST_METHOD"] == "GET"){
		$search = $_GET['search'];
		$query="select * from `users` where fname like '%$search%' and user_id not in($current)";
		$res = mysqli_query($link,$query) or die("Can't Execute Query...");
	}
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
            $sql = "SELECT * FROM `users` WHERE `user_id` = 1";
            $query = mysqli_query($link, $sql);
            $result=mysqli_fetch_array($query);
        ?>

		<form class="form-group w-25" method="GET">
			<fieldset>
			<input class="form-control" placeholder="Search any user by name" type="text" id="search" name="search" value="<?php if(isset($_GET["search"])) echo $_GET["search"]; ?>" />
			<input class="btn btn-success mt-3 px-4 py-1" type="submit" id="x" value="Search" />
			</fieldset>
		</form>

		<div class="row">

			<?php
				while($row=mysqli_fetch_assoc($res))
				{

					echo '
					<div class="col-3 mt-4 text-center">
		    			<img src="'.$row['user_image_name'].'" height="200" width="200" style="border-radius: 120px;">

		    			<p class="mt-2"><strong>'.$row['fname'].'</strong>
		    			<p
		    			style="overflow:hidden;
		    			text-overflow: ellipsis;
		    			display: inline-block;
		    			width: 180px;
		    			white-space: nowrap;
		    			overflow: hidden !important;">'.$row['description'].'</p>
		    			<a href = "profile.php?id='.$row['user_id'].'" class="btn btn-primary text-white mt-2 px-4 py-0">View Profile</a>
		    		</div> ';
    			}
    		?>

    		</div>
		</div>
    </div>

</body>
</html>
