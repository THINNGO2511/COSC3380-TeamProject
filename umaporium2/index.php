<?php
session_start();
include 'connect.php';

// Check if the user is logged in
if (isset($_SESSION["userid"])) {
    $loginButtonText = "Account";
    $loginButtonLink = "account.php"; // replace with your account page URL
} else {
    $loginButtonText = "Login";
    $loginButtonLink = "user_registration.html"; // replace with your login page URL
}
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
	</style>
</head>
<body>
<header>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="listings.html">Listings</a></li>
      <li><a href="cart.html">Cart</a></li>
      <li><a href="order.php">Order</a></li>
      <li class="login-button"><a href="<?php echo $loginButtonLink ?>"><?php echo $loginButtonText ?></a></li>
    </ul>
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

<div>
<h2> View our latest items! </h2>
<button class="glow-on-hover" type="button" onclick="window.location.href='listings.php'">Click for more!</button>
<?php
$TestObj2 = new Dbh();
$TestObj2->displaylist();
?>
</div>

<div>
<h2> Continue Shopping </h2>
<button class="glow-on-hover" type="button" onclick="window.location.href='cart.php'">Go to Cart!</button>
<img src="cart.png" alt="Icon of a shopping cart." style="margin-left:18%;width:60%;height:40%;">
</div>

<div>
<h2> Need to change something? Click below to view your account.</h2>
<button class="glow-on-hover" type="button" onclick="window.location.href='account.php'">View my Account!</button>
<br>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<h2> Click one of the options above, or use our Navigation Bar up top for more! </h2>
</main>
<footer>
<nav>
        <p style="color:#ADD8E6";> A Team 8 Project. Copyrighted COSC 3380, UH, 2023. </p>
</nav>
</footer>
</body>
</html>
