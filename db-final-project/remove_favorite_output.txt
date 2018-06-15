<!doctype html>
<html>
	<head>
		<title>Favorite Removed</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
		<h1>Favorite Removed</h1>
		<?php

		require_once 'login.php';

		$connection = mysqli_connect( $db_host, $db_user,
						$db_pass, $db_base);
		if(mysqli_connect_error()){
			die(
				"Database Connection Failed: " .
		 		mysqli_connect_error() .
		 		" (" . mysqli_connect_errno() . ")"
			);
		}; 

		$query = "DELETE FROM User_Favorites";

		if ( isset($_GET["UserID"]) && ! empty($_GET["UserID"]) && isset($_GET["title"]) && ! empty($_GET["title"]) ){

		        $id=mysqli_real_escape_string($connection,$_GET["UserID"]);
		        $title=mysqli_real_escape_string($connection,$_GET["title"]);
		        $query.=" WHERE UserID=".$id." ";
		        $query.=" and TV_Title='".$title."' ";

		        echo '<p>Removing favorite: "'.htmlentities($_GET["engagement_id"]).'".</p>'; 

		} else {

		        echo '<p>Removing all favorites.</p>';

		}

		echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 


		$result = mysqli_query($connection,$query);

		if(!$result) {
			die("Database query failed!");
		};

		if (mysqli_affected_rows($connection) == 0) {

			echo '<p style="color: red; font-weight: bold;">ERROR : Did not remove show from favorites.</p>';
			echo '<p><a href="remove_favorite_input.php">Remove Another Show from Favorites</a></p>';
			echo '<p><a href="project.php">Home</a></p>';
			echo '</body></html>';
			die();
		} else {
			echo '<p style="font-weight: bold;">Successfully removed show from favorites.</p>';
		}


		mysqli_close($connection); 

		?>
		

		<p><a href="remove_favorite_input.php">Remove Another Favorite</a></p>
		<p><a href="project.php">Home</a></p>
	</body>
</html>