<!doctype html>
<html>
	<head>
		<title>Search Users (Results)</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<style>
		p, h1, h2, h3, h4, h5, body { font-family: Helvetica, Open Sans; }
	</style>
	<body>
	
		<h1>List Users</h1>

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


			$query = "SELECT UserID, UserFirstName, UserLastName FROM Users";

			if ( isset($_GET["last_name"]) && ! empty($_GET["last_name"]) ){

				$last_name=mysqli_real_escape_string($connection,$_GET["last_name"]);
				$query.=" WHERE UserLastName Like '%".$last_name."%'";

				echo '<p>Searching for Last Names with "'.htmlentities($_GET["last_name"]).'".</p>'; 

			} else {

				echo '<p>Searching all users.</p>';

			}
			 
			$query .= " ORDER BY UserLastName ASC, UserFirstName ASC";

			echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 


			$result = mysqli_query($connection,$query);

			if(!$result) {
				die("Database query failed!");
			};

			if (mysqli_num_rows($result) == 0) {

				echo '<p style="color: red; font-weight: bold;">No results found.</p>';

			} else {
		?>

		<table border=1>
			<tr style="color:white; background-color:black;">
				<td>User ID</td>
				<td>Name</td>
			</tr>
			<?php
				while ($row = mysqli_fetch_assoc($result)){

					$id=htmlentities($row["UserID"]);
					$name=htmlentities($row["UserLastName"].', '.$row["UserFirstName"]);

					echo '<tr>';
					echo '<td>'  .  $id  .   '</td>';
					echo '<td>'  .  $name  .   '</td>';

					echo '</tr>';

				};

				};

				mysqli_free_result($result); 

				mysqli_close($connection);
			?>
		</table>
			<p><a href="search_user_input.php">Search Again</a></p>
			<p><a href="project.php">Home</a></p>
	</body>
</html>