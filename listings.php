<html>
<head>
<style>

table {
margin-left: auto;
margin-right: auto;
width: 100%;
border: 2px solid black;
}

body {
background-color: #FA8072;
}

h1 {
background-color: #FFE5B4;
color: black;
text-align: center;
}

p {
color: white;
text-align:center;
}

th, td {
border: 2px solid black;
}

</style>
</head>
<body>
<h1> Umaporium - Item Listings </h1>

<p> Please see below for our item listings. </p>

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