<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="title;">
<h1> Umaporium Staff - Inventory Editor </h1>
</div>

<br>

<div class="title">
<form action="staffportal.php">
	<button style="height:10%;width:100%"> Return to Staff Portal </button>
</form>
</div>

<br>

<div>
<p> Use the form below to edit inventory listings in the database. Enter the new details below as applicable, and enter the unique PRODUCT ID to apply them to the selected product.</p>
</div><br>

<ul>
<form name="insert" action="itemedit.php" method="POST" >
	<li>Product ID</li><li><input type="text" name="pid" /></li>
	<li>Threshold:</li><li><input type="text" name="threshold" /></li>
	<li>Clothing Line:</li><li><input type="text" name="cline" /></li>
	<li>Stock:</li><li><input type="text" name="stock" /></li>
	<li>Brand:</li><li><input type="text" name="brand" /></li>
	<li><input type="submit" /></li>
</form>
</ul>
</body>
</html>

<?php
include "connect.php";
error_reporting(0);

$TestObj = new Dbh();
$pid = $_POST['pid'];
$threshold = $_POST['threshold'];
$cline = $_POST['cline'];
$stock = $_POST['stock'];
$brand = $_POST['brand'];

if (!empty($threshold)) {
	$TestObj->invedit('itemthreshold', $threshold, $pid);
}

if (!empty($cline)) {
	$TestObj->invedit('clothingline', $cline, $pid);
}

if (!empty($stock)) {
	$TestObj->invedit('o_stock', $stock, $pid);
}

if (!empty($brand)) {
	$TestObj->invedit('brand', $brand, $pid);
}

if (empty($pid)) {
	echo "Please enter a Product ID.";
}

?>
