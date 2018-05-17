<!doctype html>
<html>
	<head>
		<title>Add New TV Show</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
	
		<h1>Add New TV Show</h1>

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


			$query = "SELECT Genre FROM Genre";

			echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 

			$result_genres = mysqli_query($connection, $query);

			if(!$result_genres) {
				die("Database query failed!");
			};

			if (mysqli_num_rows($result_genres) == 0) {

				echo '<p style="color: red; font-weight: bold;">No genres found.</p>';
				echo '</body></html>';
				die();
			} 


			$query = "SELECT Ongoing FROM Ongoing";

			echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 

			$result_ongoing = mysqli_query($connection, $query);

			if(!$result_ongoing) {
				die("Database query failed!");
			};

			if (mysqli_num_rows($result_ongoing) == 0) {

				echo '<p style="color: red; font-weight: bold;">No data found.</p>';
				echo '</body></html>';
				die();
			} 

		?>
		<p>

			<form action="add_tvshows_output.php" method="get">

				<span style="font-weight:bold;">Add New TV Show</span>
				<br/><br/>

				
				TV Show Title: <input type="text" name="title"/>
				<br/>
				Network: <input type="text" name="network"/>
				<br/>
				
				
				Genre: <select name="genre">
					<?php
				 		while ($row = mysqli_fetch_assoc($result_genres)){
							$genre=htmlentities($row["Genre"]);

							echo '<option value="' . $genre . '">'  .  $genre . '</option>';
					  	};
					?>
				</select>
				<br/>
				
				Status: <select name="ongoing">
					<?php
						while ($row = mysqli_fetch_assoc($result_ongoing)){
							$ongoing=htmlentities($row["Ongoing"]);

							echo '<option value="' . $ongoing . '">'  .  $ongoing . '</option>';
					  	};
					?>
				</select>
				
				<br/><br/>
				
				<input type="submit" value="Submit"/>

			</form>
		</p>


		<?php


		mysqli_free_result($result_genres);
		mysqli_free_result($result_ongoing);

		mysqli_close($connection); 

		?>

			<p><a href="add_tvshows_input.php">Add Another Show</a></p>
			<p><a href="project.php">Home</a></p>
	</body>
</html>