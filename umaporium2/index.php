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
.glow-on-hover {
    
width: 60%;
    margin-left: 20%;
	height: 50px;
    border: none;
    outline: none;
    color: #fff;
    background: #111;
    cursor: pointer;
    position: relative;

    z-index: 0;
    border-radius: 10px;
}

.glow-on-hover:before {
    content: '';
    background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
    position: absolute;
    top: -2px;
    left:-2px;
    background-size: 400%;
    z-index: -1;
    filter: blur(5px);
    width: calc(100% + 4px);
    height: calc(100% + 4px);
    animation: glowing 20s linear infinite;
    opacity: 0;
    transition: opacity .3s ease-in-out;
    border-radius: 10px;
}

.glow-on-hover:active {
    color: #000
}

.glow-on-hover:active:after {
    background: transparent;
}

.glow-on-hover:hover:before {
    opacity: 1;
}

.glow-on-hover:after {
    z-index: -1;
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: #111;
    left: 0;
    top: 0;
    border-radius: 10px;
}

@keyframes glowing {
    0% { background-position: 0 0; }
    50% { background-position: 400% 0; }
    100% { background-position: 0 0; }
}

h1, h2 {
text-align:center;
color:black;
}

div {
float:left;
width:30%;
margin-left:2%;
border: 5px solid black;
border-radius:5px;
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
