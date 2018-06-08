<!doctype html>
<html>
	<head>
		<title>TV Show Directory</title>
		<link rel="stylesheet" type="text/css"  href="database.css"/>
	</head>
	<style>
		p, h1, h2, h3, h4, h5, body { font-family: Helvetica, Open Sans; }
	</style>
	<body>
		<h1>TV Show Directory</h1>
		<p>
			<form method="get" action="search_tvshows_output.php">

				<b>Search all shows by title. Leave field empty and press "Submit" to show all shows.</b>

				<br/><br/>
				
				TV show title contains: <input type="text" name="title"/>
				
				<br/><br/>

				<input type="submit" value="Submit"/>
			</form>
		</p>
		<p><a href="project.php">Home</a></p>
	</body>
</html>