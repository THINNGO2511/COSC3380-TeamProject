<?php
	include 'connect.php';
?>


<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div style="width:30%;">
<h1> Umaporium - Item Listings </h1>
</div>

<br>

<div>
<h3 style="color:black;text-align:center"> Enter a search term </h3><br>
<form method="POST">
	<label for="keyword">Keyword:</label>
	<input type="text" id="keyword" name="keyword">
	<input type="submit" name="Search" class="button" value="Search" />
</form>
</div>

<br>

<div>
<p> Please see below for our item listings. </p>
</div>

<br>

<table>
	<tr>
		<th>Product_ID</th>
		<th>Name</th>
		<th>Color</th>
		<th>Category</th>
		<th>Description</th>
		<th>Brand</th>
		<th>Size</th>
		<th>Price</th>
		<th></th>
	</tr>

<?php
error_reporting(0);
$testObj = new Dbh();

if($_POST['Search']){
	$keyword = $_POST['keyword'];
	$testObj->search($keyword);
} else {
$testObj->listings();
}


?>

</table>
</body>
</html>