<html>
<head>
<style>
.center {
margin-left: auto;
margin-right: auto;
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

table {
width: 100%;
}

table, th, td {
border: 2px solid black;
text-align: center;
}
</style>
</head>
<body>
<h1> Umaporium - Item Listings </h1>

<p> Please see below for our item listings. </p>

<table class="center">
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
   while($row = pg_fetch_row($ret)) {
      echo "NAME = ". $row[1] ."\n";
      echo "DESC = ". $row[3] ."\n";
      echo "STOCK =  ".$row[4] ."\n\n";
   }
   pg_close($db);
?>