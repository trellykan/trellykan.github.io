<!doctype html>
<html>
	<head>
		<title>User Removed</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
		<h1>User Removed</h1>

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

			$query = "DELETE FROM Users";

			if ( isset($_GET["UserID"]) && ! empty($_GET["UserID"]) ){

			        $id=mysqli_real_escape_string($connection,$_GET["UserID"]);
			        $query.=" WHERE UserID=".$id." ";

			        echo '<p>Deleting the User with a UserID of "'.htmlentities($_GET["UserID"]).'".</p>'; 

			} else {

			        echo '<p>Deleting all users.</p>';

			}

			echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 


			$result = mysqli_query($connection, $query);

			if(!$result) {
				die("Could not remove user. User may still have viewing data.");
			};

			if (mysqli_affected_rows($connection) == 0) {

				echo '<p style="color: red; font-weight: bold;">ERROR: Did not delete the user.</p>';
				echo '<p><a href="delete_user_input.php">Remove Another User</a></p>';
				echo '<p><a href="project.php">Home</a></p>';
				echo '</body></html>';
				die();
			} else {
				echo '<p style="color: red; font-weight: bold;">User deleted successfully.</p>';
			}

			mysqli_close($connection); 

		?>

		<p><a href="delete_user_input.php">Delete Another User</a></p>
		<p><a href="project.php">Home</a></p>
	</body>
</html>