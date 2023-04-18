<?php
	include 'connect.php';
?>


<html>
<head>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script">
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

<h1 style="font-family:'Dancing Script'; font-size: 70px"> <center>Cougarporium</center> </h1>

<h2 style="color: black; text-align: center">View Inventory</h2>

<br>

<div style="display: flex; justify-content: center; align-items: center;">
	<div class="column4" onclick="navigateBackToStaff()">
		Return to Portal
	</div>
</div>

<script>
	function navigateBackToStaff() {
	window.location.href = 'staffportal.php';
	}
</script>

<br>

<table style="background-color: white; width: 50%; table-layout: fixed; padding-top: 50px; border-radius: 24px;">
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
