<?php
	session_start();
	include 'connect.php';
?>


<html>
<head>
<link rel="stylesheet" href="styles.css">
<style>
table {
  margin-left: auto;
  margin-right: auto;
  width: 100%;
  border: 2px solid black;
}
	
div {
border: 5px solid black;
border-radius: 5px;
width: 90%;
margin:auto;
}
</style>
</head>
<body>
<header>
  <nav>
  <?php include('./includes/navbar.php');?>
  </nav>
</header>	
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
<p> Please see below for our item listings. When you have found an item you want, enter the PRODUCT ID and click 'Add to Cart'. </p>
<form method="POST">
	<label for="id">ID:</label>
	<input type="text" id="id" name="id">
	<input type="submit" name="atc" class="button" value="Add to Cart" />
</form>

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
} 

if ($_POST['atc']){
	$id = (int)$_POST['id'];
	$uid = (int)$_SESSION['userid'];
	$testObj->atc($id, $uid);
	$testObj->listings();
} else {
$testObj->listings();
}

?>

</table>
</body>
</html>
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
