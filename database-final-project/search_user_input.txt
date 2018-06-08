<!doctype html>
<html>
	<head>
		<title>Search Users</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<style>
		p, h1, h2, h3, h4, h5, body { font-family: Helvetica, Open Sans; }
	</style>
	<body>
		<h1>Search Users</h1>
		<p>
			<form method="get" action="search_user_output.php">

				<b>Search Users by Last Name</b>

				<br/><br/>
				
				Last name contains: <input type="text" name="last_name"/>
				
				<br/><br/>

				<input type="submit" value="Submit"/>
			</form>
		</p>
		<p><a href="project.php">Home</a></p>
	</body>
</html>