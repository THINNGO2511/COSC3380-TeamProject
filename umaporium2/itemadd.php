<?php 
error_reporting(0);
include "connect.php";
$testObj = new Dbh();
?>

<html>
<head>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script">
<title>Staff: Add Item</title>
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

<?php
if($_GET['upload']=='success') {
	echo "<h2 style='color:green; text-align:center;'>Item added successfully!</h2>";
}
?>

<div class="login-form" style="width: 32%">

<br>

<p style="font-size: 15px"> Use the form to add a new item to the database. </p>

<br>

<form method="POST" action="upload.php" enctype="multipart/form-data">

	<div style="display: flex; flex-direction: column; align-items: center;">
	<label for="pname">Product Name:</label>
	<input type="text" name="pname" required/>
	</div>
	<div style="padding-top: 10px"></div>
	<div style="display: flex; flex-direction: column; align-items: center;">
	<label for="pdesc">Product Description (optional):</label>
	<input type="text" name="pdesc"/>
	</div>
	<div style="padding-top: 10px"></div>
	<div style="display: flex; flex-direction: column; align-items: center;">
	<label for="pcategory">Category:</label>
	<input list="pcategory" name="pcategory" required>
	<datalist id="pcategory">
		<?php $testObj->categoryOpt(); ?>
	</datalist>
	</div>
	<div style="padding-top: 10px"></div>
	<div style="display: flex; flex-direction: column; align-items: center;">
	<label for="psubcat">Sub-category (optional):</label>
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
	</div>
	<div style="padding-top: 10px"></div>
	<div style="display: flex; flex-direction: column; align-items: center;">
	<label for="pbrand">Brand Name:</label>
	<input list="pbrand" name="pbrand" required>
	<datalist id="pbrand">
		<?php $testObj->brandOpt(); ?>
	</datalist>
	</div>
	<div style="padding-top: 10px"></div>
	<div style="display: flex; flex-direction: column; align-items: center;">
	<label for="size">Size:</label>
	<select name="size" required>
		<option value="S">Small</option>
		<option value="M">Medium</option>
		<option value="L">Large</option>
		<option value="XL">Extra Large</option>
	</select>
	</div>
	<div style="padding-top: 10px"></div>
	<div style="display: flex; flex-direction: column; align-items: center;">
	<label for="pcolor">Color:</label>
	<input list="pcolor" name="pcolor" title="First letter must be capitalized." required>
	<datalist id="pcolor">
		<?php $testObj->colorOpt(); ?>
	</datalist>
	</div>
	<div style="padding-top: 10px"></div>
	<div style="display: flex; flex-direction: column; align-items: center;">
	<label for="price">Price (omit <em>$</em>):</label>
	<input type="number" name="price" step="0.01" min="0.01" max="99999999.99" required/>
	</div>
	<div style="padding-top: 10px"></div>
	<div style="display: flex; flex-direction: column; align-items: center;">
	<label for="image">Upload an image: </label>
	<input type="file" name="imagefile" accept="image/png" required/>
	</div>
	<div style="padding-top: 10px"></div>

	<div style="display: flex; flex-direction: column; align-items: center; padding-bottom: 30px; padding-top: 20px;">
  	<input type="submit" name="itemadd" value="Submit" style="transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#e89890'; this.style.color='white';" onmouseout="this.style.backgroundColor=''; this.style.color='';" />
	</div>

</form>

</div>
<br><br>

</body>
</html>
