<?php
	include 'connect.php';
?>


<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div style="width:30%;">
<h1> Umaporium - View Inventory </h1>
</div>

<br>

<div class="title">
<form action="staffportal.php">
	<button style="height:10%;width:100%"> Return to Staff Portal </button>
</form>
</div>

<br>

<table>
	<tr>
		<th>Item Threshold</th>
		<th>Brand</th>
		<th>Clothing Line</th>
		<th>Product ID</th>
		<th>Stock</th>
	</tr>

<?php

$testObj = new Dbh();
$testObj->viewinventory();


?>

</table>
</body>
</html>