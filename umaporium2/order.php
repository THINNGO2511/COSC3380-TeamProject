<?php
session_start();
require_once(__DIR__ . '/connect.php');
$dbh = new Dbh();

?>

<html>
	<head>
		<link rel = "stylesheet" href = "checkout_styles.css">
		<title>Cougarporium - Checkout</title>
	</head>
	<body>
		<h4><a href="./index.php"> < Back to homepage</a> &emsp; <a href="./cart.php"> < Shopping Cart</a></h4>
		<div style="text-align:center">
		<h1> Cougarporium - Checkout </h1>
		</div>
		<div class ="row">
			<div class="box">
				<div class="container">
					<h4>Cart
						<span class = "price" style="color:black">
						<i class = "fa fa-shopping-cart"></i>
						<b><?php $dbh->cartCount($_SESSION["userid"]); ?></b>
					</span>
					</h4>
				<?php $dbh->displayOrder($_SESSION["userid"]); ?> 
				<hr>
				<p>Sub-total <span class = "price" style ="color:black"><b>$ <?php echo number_format($dbh->cartTotal($_SESSION["userid"]), 2, '.', '') ?></b></span></p>
				<?php 
				$pre = $dbh->cartTotal($_SESSION["userid"]);
				$pre = $dbh->discount($_SESSION["userid"], $pre); 
				$tax = $pre * .0825;	
				?>
				<p>Tax (8.25%) <span class = "price" style ="color:black"><b>$ <?php echo number_format($tax, 2, '.', '') ?></b>
				<p>Total <span class = "price" style ="color:black"><b>$ <?php $total = $pre + $tax; echo number_format($total, 2, '.', '') ?></b>

					<?php
					if(isset($_POST['submission'])){
						$status = $dbh->insertOrder($_SESSION["userid"], number_format($total, 2, '.', ''));
						if($status == true){
							echo '<p> Order Successful :D </br>'; 
							echo 'Thanks for Shopping at THE Cougarporium!</p>';
				?>
							<form action="index.php" method="post">
  							<input type="submit" value="Back to Home" name= "Back to Home">
							</form> 
				<?php
							exit();
						}
						else{
							echo 'Order Failed :<';
						}
					} 
				?>

				<form method = "post">
				<input type="submit" value="Confirm Order" class="btn" name = "submission">
				</form>
				
				</div>
			</div>
		</div>
	</body>
			
</html>
