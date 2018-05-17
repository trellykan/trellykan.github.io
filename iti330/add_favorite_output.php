<!doctype html>
<html>
	<head>
		<title>TV Show Added to Favorites</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
	
		<h1>TV Show Added to Favorites</h1>

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

		$insert_statement = "INSERT INTO User_Favorites";


		$columns = "";
		$values = "";

		if ( isset($_GET["UserID"]) && ! empty($_GET["UserID"]) ) {

			if ($columns !== "") $columns.=', ';
			if ($values !== "") $values.=', ';

			$columns .= "UserID";
			$values .= "'".mysqli_real_escape_string($connection,$_GET["UserID"])."'";
		}


		if ( isset($_GET["title"]) && ! empty($_GET["title"]) ) {

			if ($columns !== "") $columns.=', ';
			if ($values !== "") $values.=', ';

			$columns .= "TV_Title";
			$values .= "'".mysqli_real_escape_string($connection,$_GET["title"])."'";
		}

	
		$query = $insert_statement . ' (' . $columns . ') VALUES (' . $values . ')';


		echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 


		$result = mysqli_query($connection, $query);

		if(!$result) {
			die("Database query failed!");
		};

		if (mysqli_affected_rows($connection) == 0) {

			echo '<p style="color: red; font-weight: bold;">ERROR : Did not add TV Show to favorites.</p>';
			echo '</body></html>';
			die();
		} else {
			echo '<p style="font-weight: bold;">Successfully added TV Show to favorites.</p>';
		}


		mysqli_close($connection); 

		?>

			<p><a href="add_favorite_input.php">Add Another Show to Favorites</a></p>
			<p><a href="project.php">Home</a></p>
	</body>
</html>