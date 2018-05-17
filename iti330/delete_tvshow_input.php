<!doctype html>
<html>
	<head>
		<title>Delete a TV Show</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
		<h1>Delete a TV Show</h1>

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


			$query = "SELECT TV_Title FROM TV_Show";
			$query .= " ORDER BY TV_Title ASC";

			echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 

			$result_shows = mysqli_query($connection, $query);

			if(!$result_shows) {
				die("Database query failed!");
			};

			if (mysqli_num_rows($result_shows) == 0) {

				echo '<p style="color: red; font-weight: bold;">No TV shows were found.</p>';
				echo '</body></html>';
				die();
			} 
		?>
		<p>
			<form action="delete_tvshow_output.php" method="get">
				<b>Delete Existing TV Show</b>
				<br/><br/>

				
				TV Shows: <select name="title">
				<?php

				  while ($row = mysqli_fetch_assoc($result_shows)){

					$title=htmlentities($row["TV_Title"]);

					echo '<option value="' . $title . '">' . $title . '</option>';

				  };
				?>
				</select>
				<br/><br/>
				<input type="submit" value="Submit"/>

			</form>
		</p>


		<?php


		mysqli_free_result($result_shows);

		mysqli_close($connection); 

		?>

		<p><a href="project.php">Home</a></p>
	</body>
</html>