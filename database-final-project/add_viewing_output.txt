<!doctype html>
<html>
	<head>
		<title>Viewing Added</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
	
		<h1>Viewing Added</h1>

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

		$insert_statement = "INSERT INTO Viewing";


		$columns = "";
		$values = "";

		if ( isset($_GET["date"]) && ! empty($_GET["date"]) ) {

			if ($columns !== "") $columns.=', ';
			if ($values !== "") $values.=', ';

			$columns .= "DateAired";
			$values .= "'".mysqli_real_escape_string($connection,$_GET["date"])."'";
		}


		if ( isset($_GET["start_time"]) && ! empty($_GET["start_time"]) ) {

			if ($columns !== "") $columns.=', ';
			if ($values !== "") $values.=', ';

			$columns .= "StartTime";
			$values .= "'".mysqli_real_escape_string($connection,$_GET["start_time"])."'";
		}

		if ( isset($_GET["end_time"]) && ! empty($_GET["end_time"]) ) {

			if ($columns !== "") $columns.=', ';
			if ($values !== "") $values.=', ';

			$columns .= "EndTime";
			$values .= "'".mysqli_real_escape_string($connection,$_GET["end_time"])."'";
		}


		if ( isset($_GET["duration"]) && ! empty($_GET["duration"]) ) {

			if ($columns !== "") $columns.=', ';
			if ($values !== "") $values.=', ';

			$columns .= "Duration";
			$values .= "'".mysqli_real_escape_string($connection,$_GET["duration"])."'";
		}

		if ( isset($_GET["episode_title"]) && ! empty($_GET["episode_title"]) ) {

			if ($columns !== "") $columns.=', ';
			if ($values !== "") $values.=', ';

			$columns .= "Episode_Title";
			$values .= "'".mysqli_real_escape_string($connection,$_GET["episode_title"])."'";
		}

		if ( isset($_GET["show_title"]) && ! empty($_GET["show_title"]) ) {

			if ($columns !== "") $columns.=', ';
			if ($values !== "") $values.=', ';

			$columns .= "TV_Title";
			$values .= "'".mysqli_real_escape_string($connection,$_GET["show_title"])."'";
		}

		if ( isset($_GET["ep_number"]) && ! empty($_GET["ep_number"]) ) {

			if ($columns !== "") $columns.=', ';
			if ($values !== "") $values.=', ';

			$columns .= "EpisodeNumber";
			$values .= "'".mysqli_real_escape_string($connection,$_GET["ep_number"])."'";
		}

	
		$query = $insert_statement . ' (' . $columns . ') VALUES (' . $values . ')';


		echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 


		$result = mysqli_query($connection,$query);

		if(!$result) {
			die("Database query failed!");
		};

		if (mysqli_affected_rows($connection) == 0) {

			echo '<p style="color: red; font-weight: bold;">ERROR : Did not add new viewing.</p>';
			echo '</body></html>';
			die();
		} else {
			echo '<p style="font-weight: bold;">Added new viewing.</p>';
		}


		mysqli_close($connection); 

		?>

			<p><a href="add_viewing_input.php">Add Another Viewing</a></p>
			<p><a href="project.php">Home</a></p>
	</body>
</html>