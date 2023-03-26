<html>
<head>
<link rel="stylesheet" href="style.css">
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
<form name="insert" action="itemadd.php" method="POST" >
	<li>Product Name</li><li><input type="text" name="pname" /></li>
	<li>Product Color:</li><li><input type="text" name="pcolor" /></li>
	<li>Product Description:</li><li><input type="text" name="pdesc" /></li>
	<li>Product Category:</li><li><input type="text" name="pcategory" /></li>
	<li>Sub-category (optional):</li><li><input type="text" name="psubcat" /></li>
	<li>Brand:</li><li><input type="text" name="pbrand" /></li>
	<li>Size:</li><li><input type="text" name="csizes" /></li>
	<li>Product ID:</li><li><input type="text" name=pid" /></li>
	<li><input type="submit" /></li>
</form>
</ul>
</body>
</html>

<?php
include "connect.php";
error_reporting(0);

$TestObj = new Dbh();
$TestObj->itemedit($_POST['pname'], $_POST['pcolor'], $_POST['pcategory'], $_POST['psubcat'], $_POST['pdesc'], $_POST['pbrand'], $_POST['csizes'], $_POST['pid']);

?>
