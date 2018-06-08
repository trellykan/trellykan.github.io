<!doctype html>
<html>
	<head>
		<title>Reset the Database</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
	
	<h1>Reset the Database</h1>

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


$query = file_get_contents ('reset.txt');

echo '<hr/>';
echo '<p>This is a LONG query which may take a LONG TIME.</p>';
echo '<p style="color: red; font-weight: bold;">Check the bottom of this webpage.</p>';
echo '<hr/><p>This querey is not completed until you see Success!!!.</p>';
echo '<hr/>'; 

echo '<hr/><p>These are the query statements: <br/><pre>'. $query .'</pre></p><hr/>'; 

echo '<hr/><p>RUNNING PLEASE WAIT...';

ob_flush();


$result = mysqli_multi_query($connection, $query);

if(!$result) {
	die("Database query failed!");
};

do {
    if ($res = mysqli_store_result($connection)) {
#        var_dump(mysqli_fetch_all($res,MYSQLI_ASSOC));
        echo '.';
        ob_flush();
        mysqli_free_result($res);
    }
} while (mysqli_more_results($connection) && mysqli_next_result($connection));

echo '</p><hr/>'; 
echo '<p style="color: red; font-weight: bold;">Success!!!</p>';

mysqli_close($connection);


?>

	<p><a href="reset.php">Reinitialize Again</a></p>
	<p><a href="project.php">Home</a></p>
	</body>
</html>