<!doctype html>
<html>
	<head>
		<title>TV Show Removed</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
		<h1>TV Show Removed</h1>

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

			$query = "DELETE FROM TV_Show";

			if ( isset($_GET["title"]) && ! empty($_GET["title"]) ){

			        $title=mysqli_real_escape_string($connection,$_GET["title"]);
			        $query.=" WHERE TV_Title='".$title."' ";

			        echo '<p>Deleting the TV Show: "'.htmlentities($_GET["title"]).'".</p>'; 

			} else {

			        echo '<p>Deleting all TV shows.</p>';

			}

			echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 


			$result = mysqli_query($connection, $query);

			if(!$result) {
				die("The TV Show cannot be removed because it still has viewings or users associated with it.");

			};


			if (mysqli_affected_rows($connection) == 0) {

				echo '<p style="color: red; font-weight: bold;">ERROR: Did not delete the TV Show.</p>';
				echo '<p><a href="delete_tvshow_input.php">Remove Another TV Show</a></p>';
				echo '<p><a href="project.php">Home</a></p>';
				echo '</body></html>';
				die();
			} else {
				echo '<p style="color: red; font-weight: bold;">TV Show deleted successfully.</p>';
			}

			mysqli_close($connection); 

		?>

		<p><a href="delete_tvshow_input.php">Delete Another TV Show</a></p>
		<p><a href="project.php">Home</a></p>
	</body>
</html>