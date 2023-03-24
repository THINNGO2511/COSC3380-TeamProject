<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div style="width:30%;">
<h1> Umaporium - Item Listings </h1>
</div>

<div>
<p> Please see below for our item listings. </p>
</div>

<table>
	<tr>
		<th>Item Name</th>
		<th>Item Description</th>
		<th>Item Stock</th>
	</tr>
</table>

<?php
   $host        = "host=team8-instance-1.c9gh4dcxotkn.us-east-2.rds.amazonaws.com";
   $port        = "port=5432";
   $dbname      = "dbname = postgres";
   $credentials = "user = postgres password=Uma3380+";

   $db = pg_connect( "$host $port $dbname $credentials" );   
   $sql =<<<EOF
      SELECT * from PRODUCT;
EOF;

   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   }
echo "<table>";


   while($row = pg_fetch_row($ret)) {
      echo "<tr>";
	echo "<td>" . $row['p_name'] . "</td>";
	echo "<td>" . $row['description'] . "</td>";
	echo "<td>" . $row['p_stock'] . "</td>";
	echo "</tr>";
   }
echo "</table>";
   pg_close($db);
?>
