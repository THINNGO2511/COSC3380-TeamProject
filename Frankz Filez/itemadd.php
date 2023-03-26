<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="title;">
<h1> Umaporium Staff - Item Add </h1>
</div>
<p> Use the form below to add items to the database. </p>

<ul>
<form name="insert" action="itemadd.php" method="POST" >
	<li>Product Name</li><li><input type="text" name="pname" /></li>
	<li>Product Color:</li><li><input type="text" name="pcolor" /></li>
	<li>Product Description:</li><li><input type="text" name="pdesc" /></li>
	<li>Product Category:</li><li><input type="text" name="pcategory" /></li>
	<li>Sub-category (optional):</li><li><input type="text" name="psubcat" /></li>
	<li>Brand:</li><li><input type="text" name="pbrand" /></li>
	<li>Size:</li><li><input type="text" name="csizes" /></li>
	<li><input type="submit" /></li>
</form>
</ul>
</body>
</html>

<?php
include "connect.php";
$testObj = new Dbh();
$testObj->insertproduct($_POST['pname'], $_POST['pcolor'], $_POST['pcategory'], $_POST['psubcat'], $_POST['pdesc'], $_POST['pbrand'], $_POST['csizes']);
?>
