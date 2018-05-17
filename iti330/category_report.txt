<!doctype html>
<html>
	<head>
		<title>Category Report</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
		<h1>Category Report</h1>

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

			#query to find total length


			#query to form initial table

			$query_select = "SELECT g.Genre as Genre, count(distinct tv.TV_Title) as 'Number of Shows', sum(time_to_sec(vi.Duration))/60 as TotalDuration, 100 * SUM(Duration) / (SELECT SUM(Duration) from Viewing) as Percentage";


			$query_from = " FROM Genre as g"
				. " LEFT OUTER JOIN TV_Show as tv ON g.Genre=tv.Genre" 
				. " LEFT OUTER JOIN Viewing as vi ON tv.TV_Title=vi.TV_Title";

			$query_group = " GROUP BY tv.Genre ASC";

			$query_order = " ORDER BY Percentage ASC";

			$query = $query_select . $query_from . $query_group . $query_order . ';';

			echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 


			$result = mysqli_query($connection, $query);

			if(!$result) {
				die("Database query failed! Try again.");
			};

			if (mysqli_num_rows($result) == 0) {

				echo '<p style="color: red; font-weight: bold;">No results found.</p>';

			} else {


		?>

		<h2>Showing genres, amount of shows in each genre, length of genre, and percentage of viewings for each genre.</h2>
		<table border=1>
			<tr style="color:white; background-color:black;">
				<td>Genre</td>
				<td>Number of Shows</td>
				<td>Duration of Genre</td>
				<td>Percentage of Total</td>
			</tr>

			<?php

			  while ($row = mysqli_fetch_assoc($result)){

				$genre=htmlentities($row["Genre"]);
				$numofshows=htmlentities($row["Number of Shows"]);
				$duration=htmlentities($row["TotalDuration"]);
				$percentage=htmlentities($row["Percentage"]);


				echo '<tr>';	 
				echo '<td>'  .  $genre  .   '</td>';
				echo '<td>'  .  $numofshows  .   '</td>';
				echo '<td>'  .  $duration  .   '</td>';
				echo '<td>'  .  $percentage  .   '</td>';

	
				echo '</tr>';

			  };

			};
			mysqli_free_result($result); 

			mysqli_close($connection);

			?>

		</table>

		<p><a href="category_report.php">Run Report Again</a></p>
		<p><a href="project.php">Home</a></p>
	</body>
</html>