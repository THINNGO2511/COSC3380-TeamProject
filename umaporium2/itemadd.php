<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="title;">
<h1> Umaporium Staff - Item Add </h1>
</div>

<br>

<div class="title">
<form action="staffportal.php">
	<button style="height:10%;width:100%"> Return to Staff Portal </button>
</form>
</div>

<br>

<p> Use the form below to add items to the database. </p>

<ul>
<form name="insert" action="itemadd.php" method="POST" >
	<li>Product Name</li><li><input type="text" name="pname" /></li>
	<li>Product Color:</li><li><input type="text" name="pcolor" /></li>
	<li>Product Description (optional):</li><li><input type="text" name="pdesc" /></li>
	<li>Product Category:</li><li><input type="text" name="pcategory" /></li>
	<li>Sub-category (optional):</li><li><input type="text" name="psubcat" /></li>
	<li>Brand:</li><li><input type="text" name="pbrand" /></li>
	<li>Size:</li><li><input type="text" name="csizes" /></li>
	<li>Price:</li><li><input type="text" name="price" /></li>
	<li><input type="submit" /></li>
</form>
</ul>
</body>
</html>

<?php
error_reporting(0);
include "connect.php";
$testObj = new Dbh();

$name = $_POST['pname'];
$color =  $_POST['pcolor'];
$category = $_POST['pcategory'];
$subcategory = $_POST['psubcat'];
$description = $_POST['pdesc'];
$brand = $_POST['pbrand'];
$size = $_POST['csizes'];
$price = $_POST['price'];

if (empty($description)) {
	$description = 'N/A';
}

if (empty($subcategory)) {
	$subcategory = 'N/A';
}

if (empty($name) || empty($color) || empty($category) || empty($brand) || empty($size) || empty($price)) {
	echo 'Please fill out the missing fields.';
} else {
	$testObj->insertproduct($name, $color, $category, $subcategory, $description, $brand, $size, $price);
}

?>
