
<!DOCTYPE html>
<html>
<head>
	<title>PHP PostgreSQL Connection</title>
</head>
<body>

	<?php
		// Database credentials
        $host = "team8-instance-1.c9gh4dcxotkn.us-east-2.rds.amazonaws.com";
        $dbname = "postgres";
        $username = "postgres";
        $password = "Uma3380+";

		// Attempt to connect to the database
		$conn = pg_connect("host=$host dbname=$dbname user=$username password=$password");

		// Check if the connection was successful
		if ($conn) {
			echo "Connected to the PostgreSQL database successfully.";
		} else {
			echo "Failed to connect to the PostgreSQL database.";
		}
	?>

	<br><br>

	<!-- Button to redirect to submission page -->
	<form action="submit.php" method="get">
		<button type="submit">Submit Data</button>
	</form>

</body>
</html>