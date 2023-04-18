<?php
include "connect.php";
error_reporting(0);

$testObj = new Dbh();
?>

<html>
<head>
<link rel="stylesheet" href="styles.css">
<title>Admin: Edit Item</title>
</head>
<body>
<div class="title;">
<h1> Cougarporium Staff - Item Editor </h1>
</div>

<br>
<div class="title">
<button style="height:10%;width:100%" onclick="window.location.href='staffportal.php'"> Return to Staff Portal </button>
</div>

<br>
<div class="default">
<p> Use the form below to edit items already in the database. Enter the new details below as applicable, and enter the unique PRODUCT ID to apply them to the selected product.</p>
</div><br>
<?php
if($_GET['upload']=='success') {
	echo "<h2 style='color:green; text-align:center;'>Item changes successful!</h2>";
}
?>

<div style="padding-left:1.5em;">
<div style="padding-left:1em; font-size: 1.5em; border-style:groove; width:60%;">

<form method="POST" action="upload.php?function=edit" enctype="multipart/form-data">
	<div style="padding: 1em; padding-bottom:0em">
	<label for="pid">Product ID:</label>
	<input type="text" name="pid" required/>
	<br>
	</div>

	<div style="padding: 1em; padding-bottom:0em">
	<label for="pname">Product Name:</label>
	<input type="text" name="pname" />
	<br>
	</div>

	<div style="padding: 1em; padding-bottom:0em">
	<label for="pdesc">Product Description:</label>
	<input type="text" name="pdesc"/>
	<br>
	</div>

	<div style="padding: 1em; padding-bottom:0em">
	<label for="pcategory">Category:</label>
	<input list="pcategory" name="pcategory" >
	<datalist id="pcategory">
		<?php $testObj->categoryOpt(); ?>
	</datalist>
	<br>
	</div>

	<div style="padding: 1em; padding-bottom:0em">
	<label for="psubcat">Sub-category:</label>
	<input list="psubcat" name="psubcat">
	<datalist id="psubcat">
		<option value="Shirt">
		<option value="T-shirt">
		<option value="Sweater">
		<option value="Jacket">
		<option value="Sweatpants">
		<option value="Jeans">
		<option value="Shorts">
		<option value="Dresses">
	</datalist>
	<br>
	</div>

	<div style="padding: 1em; padding-bottom:0em">
	<label for="pbrand">Brand Name:</label>
	<input list="pbrand" name="pbrand" >
	<datalist id="pbrand">
		<?php $testObj->brandOpt(); ?>
	</datalist>
	<br>
	</div>

	<div style="padding: 1em; padding-bottom:0em;">
	<label for="size">Size:</label>
	<select name="size">
		<option value="S">Small</option>
		<option value="M">Medium</option>
		<option value="L">Large</option>
		<option value="XL">Extra Large</option>
	</select>
	<br>
	</div>

	<div style="padding: 1em; padding-bottom:0em">
	<label for="pcolor">Color:</label>
	<input list="pcolor" name="pcolor" >
	<datalist id="pcolor">
		<?php $testObj->colorOpt(); ?>
	</datalist>
	<br>
	</div>

	<div style="padding: 1em; padding-bottom:0em">
	<label for="price">Price (omit <em>$</em>):</label>
	<input type="number" name="price" step="0.01" min="0.01" max="99999999.99"/>
	<br>
	</div>

	<div style="padding:1em;">
	<label for="image">Upload an image: </label>
	<input type="file" name="imagefile" accept="image/png"/>
	</div>

	<div style="padding-left:70%;">
	<input type="submit" name="Submit" value="Submit" style="width:95%; background-color:#a9d665;border-color:dimgray; border-radius: 4px; height: 3em;"/>
	</div>
</form>
</div>
</div>
</body>
</html>
