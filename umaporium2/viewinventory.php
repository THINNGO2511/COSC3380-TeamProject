<?php
	include 'connect.php';
	error_reporting(0);
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
<title>Staff: View Inventory</title>

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

<div style="display: flex; justify-content: center; align-items: center; padding-right: 20px;">
	<div class="column4" onclick="navigateBackToStaff()">
		Return to Portal
	</div>
</div>

<br>

<div style="width: 50%; border-radius: 24px; display: flex; justify-content: center; margin: auto; align-items: center; flex-direction: column; background-color: white;">
<h3 style="color:black;text-align:center"> Sort by: </h3><br>
	<form method="POST">
		<select name="sort-by">
			<option value="">--Sort By--</option>
			<option value="brand">Brand Name</option>
			<option value="stock">Stock Available</option>
			<option value="pid">Product ID</option>
		</select>
		<input type="submit" name="Search" class="button" value="Search" />
	</form>
</div> 

<br>

<table style="background-color: white; width: 50%; table-layout: fixed; padding-top: 50px; border-radius: 24px;">
	<tr>
		<th>Product ID</th>
		<th>Brand</th>
		<th>Item Threshold</th>
		<th>Stock</th>
	</tr>

<?php

$testObj = new Dbh();

if ($_POST['Search']) {
	$sort = $_POST['sort-by'];
	$testObj->viewinventory($sort);
} else {
	$sort = '';
	$testObj->viewinventory($sort);
}
?>
</table>

</body>
</html>
