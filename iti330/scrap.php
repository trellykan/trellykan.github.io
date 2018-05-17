

<!-- remove_favorite_input.php -->

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




$query = "SELECT * from User_Favorites RIGHT OUTER JOIN Users ON User_Favorites.UserID=Users.UserID";


echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 

$result_favorites = mysqli_query($connection, $query);

if(!$result_favorites) {
	die("Database query failed!");
};

if (mysqli_num_rows($result_favorites) == 0) {

	echo '<p style="color: red; font-weight: bold;">No favorites found.</p>';
	echo '</body></html>';
	die();
} 


?>
	<p>

	<form action="remove_favorite_output.php" method="get">

	<span style="font-weight:bold;">Remove TV Show from favorites.</span>
	<br/><br/>

	
	User - TV Show: <select name="favorite_id">
		<?php

		  while ($row = mysqli_fetch_assoc($result_favorites)){

			$id=htmlentities($row["UserID"]);
			$firstname=htmlentities($row["UserFirstName"]);
			$lastname=htmlentities($row["UserLastName"]);
			$title=htmlentities($row["TV_Title"]);

			echo '<option value="' . $id . '">' . $firstname . ' ' . $lastname . ' - ' . $title . '</option>';

		  };
		?>
	</select>

	<?php
	$id=htmlentities($row["UserID"]);
	$title=htmlentities($row["TV_Title"]);
	?>


	<br/><br/>
	<input type="submit" value="Submit"/>

	</form>
	</p>


<?php


mysqli_free_result($result_favorites);

mysqli_close($connection); 

?>

		<p><a href="project.php">Home</a></p>
	</body>
</html>

<!-- end remove_favorite_input.php -->

<!-- remove_favorite_output.php -->
<!doctype html>
<html>
	<head>
		<title>Favorite Removed</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
		<h1>Favorite Removed</h1>

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

$query = "DELETE FROM User_Favorites";

if ( isset($_GET["favorite_id"]) && ! empty($_GET["favorite_id"]) ){

        $id=mysqli_real_escape_string($connection,$_GET["engagement_id"]);
        $query.=" WHERE UserID=".$id." ";
        $query.=" and TV_Title=".$title." ";

        echo '<p>Removing favorite: "'.htmlentities($_GET["engagement_id"]).'".</p>'; 

} else {

        echo '<p>Removing all favorites.</p>';

}

echo '<hr/><p>This is the query statement: <br/>'. $query .'</p><hr/>'; 


$result = mysqli_query($connection,$query);

if(!$result) {
	die("Database query failed!");
};

if (mysqli_affected_rows($connection) == 0) {

	echo '<p style="color: red; font-weight: bold;">ERROR : Did not remove show from favorites.</p>';
	echo '<p><a href="./remove_engagement.php">Remove Another Show from Favorites</a></p>';
	echo '<p><a href="./project.php">Home</a></p>';
	echo '</body></html>';
	die();
} else {
	echo '<p style="font-weight: bold;">Successfulyl removed show from favorites.</p>';
}


mysqli_close($connection); 

?>

		<p><a href="delete_user_input.php">Remove Another Favorite</a></p>
		<p><a href="project.php">Home</a></p>
	</body>
</html>

<!-- end remove_favorite_output.php -->