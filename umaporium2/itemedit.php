<html>
<head>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="title;">
<h1> Umaporium Staff - Item Editor </h1>
</div>

<br>

<div class="title">
<form action="staffportal.php">
	<button style="height:10%;width:100%"> Return to Staff Portal </button>
</form>
</div>

<br>

<div>
<p> Use the form below to edit items already in the database. Enter the new details below as applicable, and enter the unique PRODUCT ID to apply them to the selected product.</p>
</div><br>

<ul>
<form name="insert" action="itemedit.php" method="POST" >
	<li>Product Name</li><li><input type="text" name="pname" /></li>
	<li>Product Color:</li><li><input type="text" name="pcolor" /></li>
	<li>Product Description:</li><li><input type="text" name="pdesc" /></li>
	<li>Product Category:</li><li><input type="text" name="pcategory" /></li>
	<li>Sub-category (optional):</li><li><input type="text" name="psubcat" /></li>
	<li>Brand:</li><li><input type="text" name="pbrand" /></li>
	<li>Size:</li><li><input type="text" name="csizes" /></li>
	<li>Price:</li><li><input type="text" name="price" /></li>
	<li>Product ID:</li><li><input type="text" name="pid" /></li>
	<li><input type="submit" /></li>
</form>
</ul>
</body>
</html>

<?php
include "connect.php";
error_reporting(0);

$TestObj = new Dbh();
$name = $_POST['pname'];
$color = $_POST['pcolor'];
$category = $_POST['pcategory'];
$subcategory = $_POST['psubcat'];
$description = $_POST['pdesc'];
$brand = $_POST['pbrand'];
$size = $_POST['csizes'];
$price = $_POST['price'];
$pid = $_POST['pid'];

if (!empty($name)) {
	$TestObj->itemedit('p_name', $name, $pid);
}

if (!empty($color)) {
	$TestObj->itemedit('color', $color, $pid);
}

if (!empty($category)) {
	$TestObj->itemedit('category', $category, $pid);
}

if (!empty($subcategory)) {
	$TestObj->itemedit('subcategory', $subcategory, $pid);
}

if (!empty($description)) {
	$TestObj->itemedit('description', $description, $pid);
}

if (!empty($brand)) {
	$TestObj->itemedit('brand', $brand, $pid);
}

if (!empty($size)) {
	$TestObj->itemedit('c_sizes', $size, $pid);
}

if (!empty($price)) {
	$TestObj->itemedit('price', $price, $pid);
}

if (empty($pid)) {
	echo "Please enter a Product ID.";
}

?>
