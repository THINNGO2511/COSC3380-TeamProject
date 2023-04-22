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
		border: 3.5px solid black;
		}
	</style>
<title>Inventory</title>

</head>
<body>

<nav>
	<h1 style="color:#fff;font-size: 2.25em; font-family: 'Dancing Script'; margin: 0">
		Cougarporium
	</h1>
</nav>

<br>

<script>
	function navigateBackToStaff() {
	window.location.href = 'staffportal.php';
	}
</script>

<div style="display: flex; justify-content: center; align-items: center;">
	<div class="column4" onclick="navigateBackToStaff()">
		Return to Portal
	</div>
</div>

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
