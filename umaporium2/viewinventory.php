<?php
	include 'connect.php';
?>


<html>
<head>
<link rel="stylesheet" href="styles.css">
<style>
table {
  margin-left: auto;
  margin-right: auto;
  width: 100%;
  border: 2px solid black;
}

</style>
</head>
<body>
<div class="title">
<h1> Cougarporium - View Inventory </h1>
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
