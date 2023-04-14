<?php
	session_start();
	include 'connect.php';
?>


<html>
<head>
<link rel="stylesheet" href="styles.css">
<title>Browse Items</title>
<style>
table {
  margin-left: auto;
  margin-right: auto;
  width: 100%;
  border: 2px solid black;
}
td {
	text-align: center;
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
	
	<select name="sort-by">
		<option value="">--Sort By--</option>
		<option value="price-LowHi">Price: Low to High</option>
		<option value="price-HiLow">Price: High to Low</option>
		<option value="bestseller">Best Sellers</option>
		<option value="new">Newest Arrivals</option>
	</select>
	<input type="submit" name="Search" class="button" value="Search" />
</form>
</div> <br>
<?php
error_reporting(0);
$testObj = new Dbh();

if($_POST['Search']){
	$keyword = $_POST['keyword'];
	$sort = $_POST['sort-by'];
	$testObj->listings($keyword, $sort);

} else {
$testObj->listings();
}
?>

</body>
</html>
