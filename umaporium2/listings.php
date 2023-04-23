<?php
	session_start();
	include 'connect.php';
?>

<html>
<head>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script">
<title>Cougarporium - Browse Items</title>
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

<h1 style="font-size: 50px; font-family:'Dancing Script'; "> Cougarporium </h1>
<h1 style="font-size: 23px"> - Item Listings - </h1>
<br>

<div style="width: 50%; border-radius: 24px; display: flex; justify-content: center; align-items: center; flex-direction: column; background-color: white;">
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
</div> 

<br>

<?php
error_reporting(0);
$testObj = new Dbh();

if ($_POST['Search']) {
    $keyword = $_POST['keyword'];
    $sort = $_POST['sort-by'];
    echo '<div style="background-color: white; border-radius: 24px">';
    $testObj->listings($keyword, $sort);
    echo '</div>';
} else {
    echo '<div style="background-color: white; border-radius: 24px">';
    $testObj->listings();
    echo '</div>';
}
?>


</body>
</html>
