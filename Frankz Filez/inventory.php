<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="title;">
<h1> Umaporium Staff - Inventory </h1>
</div>

<br>


<div style="width:15%">
<form action="staffportal.php">
	<button style="height:10%;width:100%"> Return to Staff Portal </button>
</form>
</div>

<br>

<div>
<p> The table below displays currently available stock of each item in database. Exceeding stock quota for a quarter will put particular items on discount. If stock falls below quota, orders will be sent to the respective brand for a restock. </p>
</div>

</body>
</html>

<?php
$db = pg_connect("host=team8-instance-1.c9gh4dcxotkn.us-east-2.rds.amazonaws.com dbname=postgres user=postgres password=Uma3380+") or die("Count not connect to server \n");

$query = "SELECT * FROM inventory";

$rs = pg_query($db, $query) or die("Cannot execute query: $query\n");

while($row = pg_fetch_row($rs)) {
	echo "$row[0] $row[1] $row[2]\n";
}
pg_close($db);

?>


