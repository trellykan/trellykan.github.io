<!doctype html>
<html>
	<head>
		<title>Delete Viewing</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
		<h1>Delete Viewing</h1>

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

			#query to form viewing table
			$query = "SELECT * FROM Viewing";

			#$query .= " INNER JOIN Viewing ON User_Viewings.ViewingID = Viewing.ViewingID"; 
			$query .= " ORDER BY ViewingID ASC";

			echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 


			$result = mysqli_query($connection, $query);

			if(!$result) {
				die("Database query failed! Try again.");
			};

			if (mysqli_num_rows($result) == 0) {

				echo '<p style="color: red; font-weight: bold;">No results found.</p>';

			} else {


			#query for viewingID drop-down
			$query = "SELECT ViewingID FROM Viewing";
			$query .= " ORDER BY ViewingID ASC";

			echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 

			$result_viewings = mysqli_query($connection, $query);

			if(!$result_viewings) {
				die("Database query failed!");
			};

			if (mysqli_num_rows($result_viewings) == 0) {

				echo '<p style="color: red; font-weight: bold;">No viewings found.</p>';
				echo '</body></html>';
				die();
			} 

		?>

		<h2>Showing all viewings.</h2>
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
			mysqli_free_result($result); 

			mysqli_close($connection);

			?>

		</table>

		<h2>Choose which to delete.</h2>

		<p>
			<form action="delete_viewing_output.php" method="get">	
				Viewing ID: <select name="ViewingID">
				<?php

				  while ($row = mysqli_fetch_assoc($result_viewings)){

					$id=htmlentities($row["ViewingID"]);

					echo '<option value="' . $id . '">' . $id . '</option>';

				  };
				?>
				</select>

				<br/><br/>

				<input type="submit" value="Submit"/>

			</form>
			
		</p>

		<p><a href="project.php">Home</a></p>
	</body>
</html>