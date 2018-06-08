<!doctype html>
<html>
	<head>
		<title>Delete a User</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
		<h1>Remove User</h1>

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
			<form action="delete_user_output.php" method="get">
				<b>Delete Existing User</b>
				<br/><br/>

				
				All users: <select name="UserID">
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