<!doctype html>
<html>
	<head>
		<title>New User Added</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<style>
		p, h1, h2, h3, h4, h5, body { font-family: Helvetica, Open Sans; }
	</style>
	<body>
	
	<h1>New User Added</h1>

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

			$insert_statement = "INSERT INTO Users";

			$mapping = array(
			   'first_name' => 'UserFirstName',
			   'last_name' => 'UserLastName',
			);

			$columns='';
			$values='';

			foreach ( $mapping as $get_name => $col_name) {
			   if ( isset($_GET[$get_name]) && ! empty($_GET[$get_name]) ) {

			        if ($columns !== "") $columns.=', ';
			        if ($values !== "") $values.=', ';

			        $columns .= $col_name;
			        $values .= "'".mysqli_real_escape_string($connection,$_GET[$get_name])."'";
			   }
			}

			$query = $insert_statement . ' (' . $columns . ') VALUES (' . $values . ')';

			echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 

			$result = mysqli_query($connection,$query);

			if(!$result) {
				die("Database Query Failed!");
			} else {
				echo '<p style="color: red; font-weight: bold;">New user added successfully!</p>';
			}

			mysqli_close($connection);
		?>

	<p><a href="add_user_input.php">Add Again</a></p>
	<p><a href="project.php">Home</a></p>
	</body>
</html>