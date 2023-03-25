<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div style="width:30%;">
<h1> Umaporium - Item Listings </h1>
</div>

<br>

<div>
<p> Please see below for our item listings. </p>
</div>

<br>

<table>
	<tr>
		<th>Name</th>
		<th>Color</th>
		<th>Category</th>
		<th>Description</th>
		<th>Brand</th>
		<th>Size</th>
		<th></th>
	</tr>

<?php
   $host        = "host=team8-instance-1.c9gh4dcxotkn.us-east-2.rds.amazonaws.com";
   $port        = "port=5432";
   $dbname      = "dbname = postgres";
   $credentials = "user = postgres password=Uma3380+";

   $db = pg_connect( "$host $port $dbname $credentials" ) or die("Could not connect");   

   $sql = "SELECT * from PRODUCT";

   $ret = pg_query($db, $sql) or die("Didn't work");

	


   while($row = pg_fetch_assoc($ret)) {
	echo "<tr>";
	echo "<td>" . $row['p_name'] . "</th>";
	echo "<td>" . $row['color'] . "</th>";
	echo "<td>" . $row['category'] . "</th>";
	echo "<td>" . $row['description'] . "</th>";
	echo "<td>" . $row['brand'] . "</th>";
	echo "<td>" . $row['c_sizes'] . "</th>";
	echo "<td>";
	echo "<form method='post'>";
	echo "<button type='button'>" . "Add to Cart" . "</button>";
	echo "</form>";
	echo "</td>";
	echo "</tr>";
   }

	if(array_key_exists('AddtoCart', $_POST)) {
		addtocart();
	}
	function addtocart(){
		echo "Yippee!";
	}

   pg_close($db);
?>

</table>
</body>
</html>