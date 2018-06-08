<!doctype html>
<html>
	<head>
		<title>Delete a Category</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
		<h1>Delete a Category</h1>

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
			$query .= " ORDER BY Genre ASC";

			echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 

			$result_genres = mysqli_query($connection, $query);

			if(!$result_genres) {
				die("Database query failed!");
			};

			if (mysqli_num_rows($result_genres) == 0) {

				echo '<p style="color: red; font-weight: bold;">No categories found.</p>';
				echo '</body></html>';
				die();
			} 
		?>
		<p>
			<form action="delete_category_output.php" method="get">
				<b>Delete Existing Category</b>
				<br/><br/>

				
				Categories: <select name="Genre">
				<?php

				  while ($row = mysqli_fetch_assoc($result_genres)){

					$genre=htmlentities($row["Genre"]);

					echo '<option value="' . $genre . '">' . $genre . '</option>';

				  };
				?>
				</select>
				<br/><br/>
				<input type="submit" value="Submit"/>

			</form>
		</p>


		<?php


		mysqli_free_result($result_genres);

		mysqli_close($connection); 

		?>

		<p><a href="project.php">Home</a></p>
	</body>
</html>