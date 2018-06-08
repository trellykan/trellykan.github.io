<!doctype html>
<html>
	<head>
		<title>TV Show Directory (Search Results)</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<style>
		p, h1, h2, h3, h4, h5, body { font-family: Helvetica, Open Sans; }
	</style>
	<body>
	
		<h1>TV Show Directory (Search Results)</h1>

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


			$query = "SELECT * FROM TV_Show";

			if ( isset($_GET["title"]) && ! empty($_GET["title"]) ){

				$title=mysqli_real_escape_string($connection,$_GET["title"]);
				$query.=" WHERE TV_Title Like '%".$title."%'";

				echo '<p>Searching for TV shows that contain "'.htmlentities($_GET["title"]).'".</p>'; 

			} else {

				echo '<p>Showing all TV shows.</p>';

			}
			 
			$query .= " ORDER BY TV_Title ASC";

			echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 


			$result = mysqli_query($connection, $query);

			if(!$result) {
				die("Database query failed! Try again.");
			};

			if (mysqli_num_rows($result) == 0) {

				echo '<p style="color: red; font-weight: bold;">No results found.</p>';

			} else {
		?>

		<table border=1>
			<tr style="color:white; background-color:black;">
				<td>TV Show Title</td>
				<td>Number of Favorites</td>
				<td>Network</td>
				<td>Genre</td>
				<td>Status</td>
			</tr>

			<?php

			  while ($row = mysqli_fetch_assoc($result)){

				$title=htmlentities($row["TV_Title"]);
				$favorites=htmlentities($row["Num_of_Favorites"]);
				$network=htmlentities($row["Network"]);
				$genre=htmlentities($row["Genre"]);
				$ongoing=htmlentities($row["Ongoing"]);


				echo '<tr>';	 
				echo '<td>'  .  $title  .   '</td>';
				echo '<td>'  .  $favorites . '</td>';
				echo '<td>'  .  $network . '</td>';
				echo '<td>'  .  $genre . '</td>';
				echo '<td>'  .  $ongoing . '</td>';


				echo '</tr>';

			  };

			};
			mysqli_free_result($result); 

							mysqli_close($connection);

			?>

		</table>
		<p><a href="search_tvshows_input.php">Search Again</a></p>
		<p><a href="project.php">Home</a></p>
	</body>
</html>