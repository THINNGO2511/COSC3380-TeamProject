<?php
include "connect.php";
error_reporting(0);

$testObj = new Dbh();
?>

<html>
<head>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script">
<title>Staff: Edit Item</title>
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

<!-- <div style="display: flex; flex-direction: column; margin: auto; width: 35%; align-items: center; border: 3.5px solid black; border-radius: 24px; background: whitesmoke;">
	<p> Use the form below to edit items already in the database.</p>
	<p style="margin-top: 2px"> Enter the new details below as applicable, and enter the unique PRODUCT ID to apply them to the selected product.</p>
</div> -->


<?php
if($_GET['upload']=='success') {
	echo "<h2 style='color:green; text-align:center;'>Item changes successful!</h2>";
}
?>
<table style="border:none; width:85%; margin-left: auto; margin-right: auto;">
	<thead>
		<tr>
			<th style="border:none; width:40%; text-decoration: underline; ">FORM</th>
			<th style="border:none; width:60%; text-decoration: underline; ">BROWSE ITEMS</th>
		</tr>
	</thead>
	<tbody>
			<tr>
				<td style="border:none; padding-right: 0.5em;">

				<form method="POST" action="upload.php?function=edit" enctype="multipart/form-data" class="edit-form" style="margin-top: -70px">
					<br><br>
					<div style="display: flex; flex-direction: column; align-items: center; padding-bottom: 10px">
					<label for="pid">Product ID:</label>
					<input type="text" name="pid" required/>
					</div>

					<div style="display: flex; flex-direction: column; align-items: center; padding-bottom: 10px">
					<label for="pname">Product Name:</label>
					<input type="text" name="pname" />
					</div>

					<div style="display: flex; flex-direction: column; align-items: center; padding-bottom: 10px">
					<label for="pdesc">Product Description:</label>
					<input type="text" name="pdesc"/>
					</div>

					<div style="display: flex; flex-direction: column; align-items: center; padding-bottom: 10px">
					<label for="pcategory">Category:</label>
					<input list="pcategory" name="pcategory" >
					<datalist id="pcategory">
						<?php $testObj->categoryOpt(); ?>
					</datalist>
					</div>

					<div style="display: flex; flex-direction: column; align-items: center; padding-bottom: 10px">
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
					</div>

					<div style="display: flex; flex-direction: column; align-items: center; padding-bottom: 10px">
					<label for="pbrand">Brand Name:</label>
					<input list="pbrand" name="pbrand" >
					<datalist id="pbrand">
						<?php $testObj->brandOpt(); ?>
					</datalist>
					</div>

					<div style="display: flex; flex-direction: column; align-items: center; padding-bottom: 10px">
					<label for="size">Size:</label>
					<select name="size">
						<option value="S">Small</option>
						<option value="M">Medium</option>
						<option value="L">Large</option>
						<option value="XL">Extra Large</option>
					</select>
					</div>

					<div style="display: flex; flex-direction: column; align-items: center; padding-bottom: 10px">
					<label for="pcolor">Color:</label>
					<input list="pcolor" name="pcolor" >
					<datalist id="pcolor">
						<?php $testObj->colorOpt(); ?>
					</datalist>
					</div>

					<div style="display: flex; flex-direction: column; align-items: center; padding-bottom: 10px">
					<label for="price">Price (omit <em>$</em>):</label>
					<input type="number" name="price" step="0.01" min="0.01" max="99999999.99"/>
					</div>

					<div style="display: flex; flex-direction: column; align-items: center; padding-bottom: 10px">
					<label for="image">Upload an image: </label>
					<input type="file" name="imagefile" accept="image/png"/>
					</div>

					<div style="padding-bottom: 25px; padding-top: 10px;">
					<input type="submit" name="Submit" value="Submit" style="transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#e89890'; this.style.color='white';" onmouseout="this.style.backgroundColor=''; this.style.color='';"/>
					</div>

				</form>
				</td>

				<td style="border:none; padding-left: 0.5em;">

				<div style="height: 40em; overflow:auto; border: 3.5px solid black; background-color: white; border-radius: 24px; padding: 14px;">
					<?php $testObj->listings();?>
				</div>
				</td>

			</tr>
	</tbody>
</table>

<div style="padding-bottom: 50px"></div>
</body>
</html>
