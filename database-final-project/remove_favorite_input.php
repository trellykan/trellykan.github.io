<!doctype html>
<html>
	<head>
		<title>Remove Favorite</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
		<h1>Remove Favorite</h1>

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

			#query to form initial table
			$query = "SELECT * FROM User_Favorites";

			$query .= " INNER JOIN Users ON User_Favorites.UserID = Users.UserID"; 
			$query .= " ORDER BY User_Favorites.UserID ASC";

			echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 


			$result = mysqli_query($connection, $query);

			if(!$result) {
				die("Database query failed! Try again.");
			};

			if (mysqli_num_rows($result) == 0) {

				echo '<p style="color: red; font-weight: bold;">No results found.</p>';

			} else {


			#query for users drop-down
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

			#query for tv_title drop-down
			$query = "SELECT DISTINCT TV_Title FROM User_Favorites";
			$query .= " ORDER BY TV_Title ASC";

			echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 

			$result_titles = mysqli_query($connection, $query);

			if(!$result_titles) {
				die("Database Query Failed!");
			};

			if (mysqli_num_rows($result_titles) == 0) {

				echo '<p style="color: red; font-weight: bold;">No titles found.</p>';
				echo '</body></html>';
				die();
			} 

		?>

		<h2>Showing all user favorites.</h2>
		<table border=1>
			<tr style="color:white; background-color:black;">
				<td>User ID</td>
				<td>User First Name</td>
				<td>User Last Name</td>
				<td>TV Show Title</td>
			</tr>

			<?php

			  while ($row = mysqli_fetch_assoc($result)){

				$userid=htmlentities($row["UserID"]);
				$userfirstname=htmlentities($row["UserFirstName"]);
				$userlastname=htmlentities($row["UserLastName"]);
				$title=htmlentities($row["TV_Title"]);

				echo '<tr>';	 
				echo '<td>'  .  $userid  .   '</td>';
				echo '<td>'  .  $userfirstname  .   '</td>';
				echo '<td>'  .  $userlastname  .   '</td>';
				echo '<td>'  .  $title . '</td>';
	
				echo '</tr>';

			  };

			};
			mysqli_free_result($result); 

			mysqli_close($connection);

			?>

		</table>

		<h2>Choose which to delete.</h2>

		<p>
			<form action="remove_favorite_output.php" method="get">	
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


				TV Show: <select name="title">
				<?php

				  while ($row = mysqli_fetch_assoc($result_titles)){

					$title=htmlentities($row["TV_Title"]);

					echo '<option value="' . $title . '">' . $title . '</option>';

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