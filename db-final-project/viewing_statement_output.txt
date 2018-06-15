<!doctype html>
<html>
	<head>
		<title>Viewing Statement</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
	
	<h1>Viewing Statement for Chosen Times</h1>

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

		$query_select = "SELECT *";


		$query_from = " FROM Viewing";


		if ( isset($_GET["start_time"]) && ! empty($_GET["start_time"]) ) {
			$st=$_GET["start_time"];
		} else {
			echo '<p>Error: Invalid input.</p>';
		}

		if ( isset($_GET["end_time"]) && ! empty($_GET["end_time"]) ) {
			$et=$_GET["end_time"];
		} else {
			echo '<p>Error: Invalid input.</p>';
		}


		$query_where = " WHERE StartTime >= '" . mysqli_real_escape_string($connection, $st). "' AND StartTime < "
			. "'" . mysqli_real_escape_string($connection, $et) . "'";

		echo '<p>Showing viewings that started after "' . htmlentities($st) . '".</p>'; 

		echo '<p>Showing viewings that started before "' . htmlentities($et) . '".</p>'; 


		$query_order = " ORDER BY DateAired ASC, StartTime ASC";

		$query = $query_select . $query_from . $query_where . $query_order;

		echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 


		$result = mysqli_query($connection, $query);

		if(!$result) {
			die("Database query failed!");
		};

		if (mysqli_num_rows($result) == 0) {

			echo '<p style="color: red; font-weight: bold;">No results found.</p>';

		} else {

		?>

		<table border=1>
		<tr style="color:white; background-color:black;">
			<td>Viewing ID</td>
			<td>TV Show Title</td>
			<td>Episode Title</td>
			<td>Episode Number</td>
			<td>Date Aired</td>
			<td>Start Time</td>
			<td>End Time</td>
		</tr>

		<?php

		  while ($row = mysqli_fetch_assoc($result)){

			$viewingid=htmlentities($row["ViewingID"]);
				$show_title=htmlentities($row["TV_Title"]);
				$ep_title=htmlentities($row["Episode_Title"]);
				$ep_number=htmlentities($row["EpisodeNumber"]);
				$date=htmlentities($row["DateAired"]);
				$start_time=htmlentities($row["StartTime"]);
				$end_time=htmlentities($row["EndTime"]);


				echo '<tr>';	 
				echo '<td>'  .  $viewingid  .   '</td>';
				echo '<td>'  .  $show_title  .   '</td>';
				echo '<td>'  .  $ep_title  .   '</td>';
				echo '<td>'  .  $ep_number . '</td>';
				echo '<td>'  .  $date  .   '</td>';
				echo '<td>'  .  $start_time  .   '</td>';
				echo '<td>'  .  $end_time . '</td>';

			echo '</tr>';

		  };

		};

		?>

		</table>

		<?php

		mysqli_free_result($result); 


		$query_select = "SELECT SUM(Duration) as Total";

		$query = $query_select . $query_from . $query_where . $query_order;

		echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 

		$result = mysqli_query($connection, $query);

		if(!$result) {
			die("Database query failed!");
		};

		if ( $row = mysqli_fetch_assoc($result)) {
			echo '<p>The TOTAL duration of this selected time is ' . $row["Total"] . '.</p>';
		};


		?>
		
		<?php
		mysqli_free_result($result); 


		$query_select = "SELECT SUM(Duration) as Total";

		$query = $query_select . $query_from;

		echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 

		$result = mysqli_query($connection, $query);

		if(!$result) {
			die("Database query failed!");
		};

		if ( $row = mysqli_fetch_assoc($result)) {
			echo '<p>The total duration of ALL viewings is ' . $row["Total"] . '.</p>';
		};

		mysqli_free_result($result); 

		mysqli_close($connection);


		?>

	<p><a href="viewing_statement_input.php">Produce New Viewing Statement</a></p>
	<p><a href="project.php">Home</a></p>
	</body>
</html>