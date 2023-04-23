<?php
include "connect.php";
error_reporting(0);

$testObj = new Dbh();
?>

<html>
<head>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script">
<title>Staff: Edit Inventory</title>
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

<!-- <div class="default">
<p> Use the form below to edit inventory listings in the database. Enter the new details below as applicable, and enter the unique PRODUCT ID to apply them to the selected product.</p>
</div> -->

<br>

<?php
if($_GET['upload']=='success') {
	echo "<h2 style='color:green; text-align:center;'>Inventory changes successful!</h2>";
}
?>
<table style="border:none; width:85%; margin-left: auto; margin-right: auto;">
	<thead>
		<tr>
		<th style="border:none; width:40%; text-decoration: underline; ">FORM</th>
			<th style="border:none; width:60%; text-decoration: underline; ">BROWSE INVENTORY</th>
		</tr>
	</thead>
	<tbody>
		<tr>
		<td style="border:none; padding-right: 1em;">

		<form method="POST" action="upload.php" enctype="multipart/form-data" class="edit-form" style="margin-top: -337px; width: 40%">
			<br><br>
			<div style="display: flex; flex-direction: column; align-items: center; padding-bottom: 10px">
			<label for="pid">Product ID:</label>
			<input type="text" name="pid" required/>
			</div>

			<div style="display: flex; flex-direction: column; align-items: center; padding-bottom: 10px">
			<label for="threshold">Item Threshold:</label>
			<input type="text" name="threshold" />
			</div>

			<div style="display: flex; flex-direction: column; align-items: center; padding-bottom: 10px">
			<label for="stock">Stock:</label>
			<input type="text" name="stock" />
			</div>

			<div style="display: flex; flex-direction: column; align-items: center; padding-bottom: 10px">
			<label for="brand">Brand:</label>
			<input type="text" name="brand" />
			</div>

			<div style="padding-bottom: 25px; padding-top: 10px;">
			<input type="submit" name="invedit" value="Submit" style="transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#e89890'; this.style.color='white';" onmouseout="this.style.backgroundColor=''; this.style.color='';"/>
			</div>
		</form>

		</td>

		<td style="border:none; padding-left: 1em;">
		<div style="height: 40em; overflow:auto; border: 3.5px solid black; background-color: white; border-radius: 24px; padding: 14px;">
				<!-- <table style="margin-left: auto; margin-right: auto; width: 100%; border: black; background-color: white;"> -->
				<table style="width: 100%;">
					<tr>
					<th>Item Threshold</th>
					<th>Brand</th>
					<th>Product ID</th>
					<th>Stock</th>
					</tr>
				<?php 
				$sort = '';
				$testObj->viewinventory($sort);
				?>
				</table>
			</div>
		</td>

		</tr>
	</tbody>
</table>
<div style="padding-bottom: 50px"></div>
</body>
</html>
