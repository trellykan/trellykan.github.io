<!doctype html>
<html>
	<head>
		<title>Add a Customer - Input</title>
	</head>
	<body>
	
	<h1>Add a Customer</h1>

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

## THIS IS A VERY STRAIGHT FORWARD WAY TO BUILD THE QUERY STRING 
#$query = "INSERT INTO EA_Customers (CustFirstName, CustLastName, CustStreetAddress, CustCity, CustState, CustZipCode, CustPhoneNumber) ";
#$query .= "VALUES (";
#$query .= ", '" .  $_GET["first_name"] . "'";
#$query .= ", '" .  $_GET["last_name"] . "'";
#$query .= ", '" .  $_GET["street"] . "'";
#$query .= ", '" .  $_GET["city"] . "'";
#$query .= ", '" .  $_GET["state"] . "'";
#$query .= ", '" .  $_GET["zip"] . "'";
#$query .= ", '" .  $_GET["phone"] . "'";
#$query .= ")";

# THE FOLLOWING IS A COMPLEX WAY TO BUILD THE QUERY STRING

$insert_statement = "INSERT INTO EA_Customers";

$mapping = array(
   'first_name' => 'CustFirstName',
   'last_name' => 'CustLastName',
   'street' => 'CustStreetAddress',
   'city' => 'CustCity',
   'state' => 'CustState',
   'zip' => 'CustZipCode',
   'phone' => 'CustPhoneNumber'
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


 
#UNCOMMENT FOR DEBUG
echo '<hr/><p>This is my query... <br/>'. $query .'</p><hr/>'; 




$result = mysqli_query($connection,$query);

if(!$result) {
	die("Database Query Failed!");
} else {

echo '<p style="color: red; font-weight: bold;">Success!!!</p>';

}


mysqli_close($connection);


?>
	<p><a href="./add_customer.php">Add Again</a></p>
	<p><a href="./project.php">Home</a></p>
	</body>
</html>