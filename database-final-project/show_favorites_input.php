<!doctype html>
<html>
	<head>
		<title>Show Favorites</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
		<h1>Show Favorites</h1>

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
		?>
		<p>
			<form action="show_favorites_output.php" method="get">
				<b>Show Favorites for User - Select User</b>
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
				<br/><br/>
				<input type="submit" value="Submit"/>

			</form>
		</p>


		<?php


		mysqli_free_result($result_users);

		mysqli_close($connection); 

		?>

		<p><a href="project.php">Home</a></p>
	</body>
</html>