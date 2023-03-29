<?php
session_start();
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Umaporium - Home</title>
    <link rel="stylesheet" href="styles.css">
	
<style>
h1, h2 {
text-align:center;
color:black;
}
	
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
<main>

<?php
if (!isset($_SESSION["userid"])) {
	echo "<h1>Welcome to the Umaporium!</h1>";
} else {
	$uid = $_SESSION["userid"];
	$TestObj = new Dbh();
	$TestObj->display($uid);
}
?>
<br>

<div class="column3">
<h2> View our latest items! </h2>
<button class="glow-on-hover" type="button" onclick="window.location.href='listings.php'">Click for more!</button>
<br><br><br>
<?php
$TestObj2 = new Dbh();
$TestObj2->displaylist();
?>
</div>

<div class="column3">
<h2> Continue Shopping </h2>
<button class="glow-on-hover" type="button" onclick="window.location.href='cart.php'">Go to Cart!</button>
<br><br>
<img src="cart.png" alt="Icon of a shopping cart." style="margin-left:18%;width:60%;height:40%;">
</div>

<div class="column3">
<h2> Need to change something? Click below to view your account.</h2>
<button class="glow-on-hover" type="button" onclick="window.location.href='account.php'">View my Account!</button>
<br><br><br>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<h2> Click one of the options above, or use our Navigation Bar up top for more! </h2>
</main>
<footer>
<nav>
        <p style="color:#ADD8E6";> A Team 8 Project. Copyrighted COSC 3380, UH, 2023. </p>
</nav>
</footer>
</body>
</html>
