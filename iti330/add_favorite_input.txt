<!doctype html>
<html>
	<head>
		<title>Add a TV Show to Your Favorites</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
	
		<h1>Add a TV Show to Your Favorites</h1>

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


			$query = "SELECT UserID as ID, UserFirstName, UserLastName FROM Users";
			$query .= " ORDER BY UserLastName ASC, UserFirstName ASC";

			echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 

			$result_users = mysqli_query($connection,$query);

			if(!$result_users) {
				die("Database query failed!");
			};

			if (mysqli_num_rows($result_users) == 0) {

				echo '<p style="color: red; font-weight: bold;">No users found.</p>';
				echo '</body></html>';
				die();
			} 


			$query = "SELECT TV_Title FROM TV_Show";
			$query .= " ORDER BY TV_Title ASC";

			echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 

			$result_titles = mysqli_query($connection, $query);

			if(!$result_titles) {
				die("Database query failed!");
			};

			if (mysqli_num_rows($result_titles) == 0) {

				echo '<p style="color: red; font-weight: bold;">No shows found.</p>';
				echo '</body></html>';
				die();
			} 

		?>
		<p>

			<form action="add_favorite_output.php" method="get">

				<span style="font-weight:bold;">Favorite a TV Show</span>
				<br/><br/>
				
				User: <select name="UserID">
				<?php

				  while ($row = mysqli_fetch_assoc($result_users)){

					$id=htmlentities($row["ID"]);
				        $name=htmlentities($row["UserLastName"].', '.$row["UserFirstName"]);

					echo '<option value="' . $id . '">' . $name . '</option>';

				  };
				?>
				</select>
				<br/>
				
				TV Show: <select name="title">
					<?php
						while ($row = mysqli_fetch_assoc($result_titles)){
							$title=htmlentities($row["TV_Title"]);

							echo '<option value="' . $title . '">'  .  $title . '</option>';
					  	};
					?>
				</select>
				
				<br/><br/>
				
				<input type="submit" value="Submit"/>

			</form>
		</p>


		<?php


		mysqli_free_result($result_users);
		mysqli_free_result($result_titles);

		mysqli_close($connection); 

		?>

			<p><a href="add_favorite_input.php">Favorite Another Show</a></p>
			<p><a href="project.php">Home</a></p>
	</body>
</html>