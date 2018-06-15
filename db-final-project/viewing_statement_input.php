<!doctype html>
<html>
	<head>
		<title>Viewing Statement</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<body>
	
	<h1>Produce Viewing Statement</h1>

	<p>
	<form method="get" action="viewing_statement_output.php">

	<span style="font-weight:bold;">Choose two times of day to produce viewing statement.</span>
	<br/><br/>
	
	Started Time (hh:mm:ss): <input type="text" name="start_time"/>
	<br/><br/>
	End Time (hh:mm:ss): <input type="text" name="end_time"/>

	<br/><br/>
	<input type="submit" value="Submit"/>

	</form>
	</p>

	<p><a href="project.php">Home</a></p>
	</body>
</html>