<!doctype html>
<html>
	<head>
		<title>Add Viewing</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
	
	<h1>Add Viewing</h1>

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


	#query for drop-down TV_Title
	$query = "SELECT DISTINCT TV_Title FROM TV_Show";

	echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 

	$result_shows = mysqli_query($connection,$query);

	if(!$result_shows) {
		die("Database Query Failed!");
	};

	if (mysqli_num_rows($result_shows) == 0) {

		echo '<p style="color: red; font-weight: bold;">No shows found.</p>';
		echo '</body></html>';
		die();
	} 

	?>

		<p>

		<form action="add_viewing_output.php" method="get">

		<span style="font-weight:bold;">Add New Viewing</span>
		<br/><br/>

		
		Date Aired (yyyy-mm-dd): <input type="text" name="date"/>
		<br/><br/>
		Start Time (hh:mm:ss): <input type="text" name="start_time"/>
		<br/><br/>
		End Time (hh:mm:ss): <input type="text" name="end_time"/>
		<br/><br/>
		Duration (hh:mm:ss): <input type="text" name="duration"/>
		<br/><br/>
		Episode Title: <input type="text" name="episode_title"/>
		<br/><br/>
		
		TV Show Title: <select name="show_title">
	<?php

	  while ($row = mysqli_fetch_assoc($result_shows)){

		$show_title=htmlentities($row["TV_Title"]);

		echo '<option value="' . $show_title . '">'  .  $show_title . '</option>';

	  };
	?>
		</select>
		<br/><br/>
		Episode Number: <input type="text" name="ep_number"/>

		<br/><br/>
		<input type="submit" value="Submit"/>

		</form>
		</p>


	<?php

	mysqli_free_result($result_shows);

	mysqli_close($connection); 

	?>

	<p><a href="./add_engagement.php">Search Again</a></p>
	<p><a href="./project.php">Home</a></p>
	</body>
</html>