<?php
session_start();
require_once(__DIR__ . '/connect.php');
$dbh = new Dbh();
$itemCount = $dbh->cartCount($_SESSION["userid"]);
?>

<html>
	<head>
		<link rel = "stylesheet" href = "checkout_styles.css">
		<title>Shopping Cart</title>
	</head>
	<body>
        <h4><a href="./index.php"> < Back to homepage</a></h4>
		<div style="text-align:center">
        <h1> My Shopping Cart </h1>
        </div>
		<div class ="row">
			<div class="box">
				<div class="container">
					<h4>Cart (<?php if($itemCount > 0){echo $itemCount;} else{echo 0;} ?>)	
                    <span class = "price" style="color:black">
					<i class = "fa fa-shopping-cart"></i>
					</span>
					</h4>
				<?php
                if($itemCount > 0) {
                    $dbh->displayCart($_SESSION["userid"]); ?> 
				<hr>
				<p>Sub-total <span class = "price" style ="color:black"><b>$ <?php echo number_format($dbh->cartTotal($_SESSION["userid"]), 2, '.', '') ?></b></span></p>
				<?php 
				$pre = $dbh->cartTotal($_SESSION["userid"]);
				$tax = $pre * .0725;	
				?>
				<p>Tax <span class = "price" style ="color:black"><b>$ <?php echo number_format($tax, 2, '.', '') ?></b>
				<p>Total <span class = "price" style ="color:black"><b>$ <?php $total = $pre + $tax; echo number_format($total, 2, '.', '') ?></b>

				
                </div>
				
                <button class="btn" type="button" onclick="window.location.href='order.php'">Checkout</button>
                <br><br><br>
                <?php
                if(isset($_POST["empty-cart"])) {
                    $dbh->emptyCart($_SESSION["userid"]);
                    header('location: cart.php');} 
                    ?>
                <div style="text-align:left">
                <form method="post">
                <input type="submit" value="Empty Cart" name ="empty-cart"> 
                </form>
                </div>
                <?php }
                else { ?> 
                <div style="text-align:center"><h5>Looks like your cart is empty.</h5></div>
                <button class="btn" type="button" onclick="window.location.href='listings.php'">Shop for items!</button> 
                <?php } ?>
			</div>
		</div>
	</body>
			
</html>
