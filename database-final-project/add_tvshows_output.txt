<!doctype html>
<html>
	<head>
		<title>TV Show Added</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
	
		<h1>TV Show Added</h1>

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

		$insert_statement = "INSERT INTO TV_Show";


		$columns = "";
		$values = "";

		if ( isset($_GET["title"]) && ! empty($_GET["title"]) ) {

			if ($columns !== "") $columns.=', ';
			if ($values !== "") $values.=', ';

			$columns .= "TV_Title";
			$values .= "'".mysqli_real_escape_string($connection,$_GET["title"])."'";
		}


		if ( isset($_GET["network"]) && ! empty($_GET["network"]) ) {

			if ($columns !== "") $columns.=', ';
			if ($values !== "") $values.=', ';

			$columns .= "Network";
			$values .= "'".mysqli_real_escape_string($connection,$_GET["network"])."'";
		}

		if ( isset($_GET["genre"]) && ! empty($_GET["genre"]) ) {

			if ($columns !== "") $columns.=', ';
			if ($values !== "") $values.=', ';

			$columns .= "Genre";
			$values .= "'".mysqli_real_escape_string($connection,$_GET["genre"])."'";
		}


		if ( isset($_GET["ongoing"]) && ! empty($_GET["ongoing"]) ) {

			if ($columns !== "") $columns.=', ';
			if ($values !== "") $values.=', ';

			$columns .= "Ongoing";
			$values .= "'".mysqli_real_escape_string($connection,$_GET["ongoing"])."'";
		}

	
		$query = $insert_statement . ' (' . $columns . ') VALUES (' . $values . ')';


		echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 


		$result = mysqli_query($connection,$query);

		if(!$result) {
			die("Database query failed!");
		};

		if (mysqli_affected_rows($connection) == 0) {

			echo '<p style="color: red; font-weight: bold;">ERROR : Did not add new TV Show.</p>';
			echo '</body></html>';
			die();
		} else {
			echo '<p style="font-weight: bold;">Added new TV Show.</p>';
		}


		mysqli_close($connection); 

		?>

			<p><a href="add_tvshows_input.php">Add Another Show</a></p>
			<p><a href="project.php">Home</a></p>
	</body>
</html>