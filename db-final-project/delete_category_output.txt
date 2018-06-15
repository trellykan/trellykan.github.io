<!doctype html>
<html>
	<head>
		<title>Category Removed</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
		<h1>Category Removed</h1>

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

			$query = "DELETE FROM Genre";

			if ( isset($_GET["Genre"]) && ! empty($_GET["Genre"]) ){

			        $genre=mysqli_real_escape_string($connection,$_GET["Genre"]);
			        $query.=" WHERE Genre='".$genre."' ";

			        echo '<p>Deleting the category of "'.htmlentities($_GET["Genre"]).'".</p>'; 

			} else {

			        echo '<p>Deleting all categories.</p>';

			}

			echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 


			$result = mysqli_query($connection, $query);

			if(!$result) {
				die("The category cannot be removed because it still has TV shows associated with it.");

			};


			if (mysqli_affected_rows($connection) == 0) {

				echo '<p style="color: red; font-weight: bold;">ERROR: Did not delete the category.</p>';
				echo '<p><a href="delete_category_input.php">Remove Another Category</a></p>';
				echo '<p><a href="project.php">Home</a></p>';
				echo '</body></html>';
				die();
			} else {
				echo '<p style="color: red; font-weight: bold;">Category deleted successfully.</p>';
			}

			mysqli_close($connection); 

		?>

		<p><a href="delete_category_input.php">Delete Another Category</a></p>
		<p><a href="project.php">Home</a></p>
	</body>
</html>