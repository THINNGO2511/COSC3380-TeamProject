<?php
include "connect.php";
error_reporting(0);

$testObj = new Dbh();
?>

<html>
<head>
<link rel="stylesheet" href="styles.css">
<title>Staff: Edit Inventory</title>
</head>
<body>
<div class="title;">
<h1> Cougarporium Staff - Inventory Editor </h1>
</div>

<br>
<div class="title">
<button style="height:10%;width:100%" onclick="window.location.href='staffportal.php'"> Return to Staff Portal </button>
</div>

<br>
<div class="default">
<p> Use the form below to edit inventory listings in the database. Enter the new details below as applicable, and enter the unique PRODUCT ID to apply them to the selected product.</p>
</div><br>
<?php
if($_GET['upload']=='success') {
	echo "<h2 style='color:green; text-align:center;'>Inventory changes successful!</h2>";
}
?>
<table style="border:none; width:100%;">
	<thead>
		<tr>
			<th style="border:none; width:40%">FORM</th>
			<th style="border:none; width:60%">BROWSE INVENTORY</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td style="border:none;">

<div style="padding-left: 1em; font-size: 1em; border-style:groove; width:70%;">
<form method="POST" action="upload.php?function=inv" enctype="multipart/form-data">
	<div style="padding: 1em; padding-bottom:0em">
	<label for="pid">Product ID:</label>
	<input type="text" name="pid" required/>
	<br>
	</div>

	<div style="padding: 1em; padding-bottom:0em">
	<label for="threshold">Item Threshold:</label>
	<input type="text" name="threshold" required/>
	<br>
	</div>

	<div style="padding: 1em; padding-bottom:0em">
	<label for="stock">Stock:</label>
	<input type="text" name="stock" required/>
	<br>
	</div>

	<div style="padding: 1em; padding-bottom:0em">
	<label for="brand">Brand:</label>
	<input type="text" name="brand" required/>
	<br>
	</div>

	<div style="padding-left:70%;">
	<input type="submit" name="Submit" value="Submit" style="width:95%; background-color:#a9d665; border-color:dimgray; border-radius: 4px; height: 3em;"/>
	</div>
</form>
</div>

			</td>
			<td style="border:none">
			<div style="height: 40em; overflow:auto;">
				<table style="margin-left: auto; margin-right: auto; width: 100%; border: 3.5px solid black; background-color: white;">
				<tr>
					<th>Item Threshold</th>
					<th>Brand</th>
					<th>Product ID</th>
					<th>Stock</th>
				</tr>
				<?php $testObj->viewinventory();?>
				</table>
			</div>
			</td>
		</tr>
	</tbody>
</table>
</body>
</html>
