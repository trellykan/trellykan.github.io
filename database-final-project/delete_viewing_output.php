<!doctype html>
<html>
	<head>
		<title>Viewing Deleted</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
		<h1>Viewing Deleted</h1>
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

		$query = "DELETE FROM User_Viewings";

		if ( isset($_GET["ViewingID"]) && ! empty($_GET["ViewingID"]) ){

		        $id=mysqli_real_escape_string($connection, $_GET["ViewingID"]);
		        $query.=" WHERE ViewingID='".$id."'";

		        echo '<p>Deleted viewing: "'.htmlentities($_GET["ViewingID"]).'".</p>'; 

		} else {

		        echo '<p>Deleting all viewings.</p>';

		}

		echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 


		$result = mysqli_query($connection, $query);

		if(!$result) {
			die("Database query failed!");
		};

		if (mysqli_affected_rows($connection) == 0) {

			echo '<p style="color: red; font-weight: bold;">ERROR : Could not delete the viewing.</p>';
			echo '<p><a href="delete_viewing_input.php">Delete another viewing</a></p>';
			echo '<p><a href="project.php">Home</a></p>';
			echo '</body></html>';
			die();
		} else {
			echo '<p style="font-weight: bold;">Successfully deleted the viewing.</p>';
		}

		mysqli_close($connection); 

		?>

		<!-- delete from viewing -->

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

		$query = "DELETE FROM Viewing";

		if ( isset($_GET["ViewingID"]) && ! empty($_GET["ViewingID"]) ){

		        $id=mysqli_real_escape_string($connection, $_GET["ViewingID"]);
		        $query.=" WHERE ViewingID='".$id."'";

		        echo '<p>Deleted viewing: "'.htmlentities($_GET["ViewingID"]).'".</p>'; 

		} else {

		        echo '<p>Deleting all viewings.</p>';

		}

		echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 


		$result = mysqli_query($connection, $query);

		if(!$result) {
			die("Database query failed!");
		};

		if (mysqli_affected_rows($connection) == 0) {

			echo '<p style="color: red; font-weight: bold;">ERROR : Could not delete the viewing.</p>';
			echo '<p><a href="delete_viewing_input.php">Delete another viewing</a></p>';
			echo '<p><a href="project.php">Home</a></p>';
			echo '</body></html>';
			die();
		} else {
			echo '<p style="font-weight: bold;">Successfully deleted the viewing.</p>';
		}

		mysqli_close($connection); 

		?>
		

		<p><a href="delete_viewing_input.php">Delete Another Viewing</a></p>
		<p><a href="project.php">Home</a></p>
	</body>
</html>