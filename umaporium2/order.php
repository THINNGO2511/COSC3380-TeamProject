<?php
session_start();
require_once(__DIR__ . 'connect.php');
$dbh = new Dbh();

?>

<html>
	<head>
		<link rel = "stylesheet" href = "checkout_styles.css">
	</head>
	<body>
		<h1> Umaporium - Checkout </h1>
		<div class ="row">
			<div class="box">
				<div class="container">
					<h4>Cart
						<span class = "price" style="color:black">
						<i class = "fa fa-shopping-cart"></i>
						<b><?php $dbh->cartCount($_SESSION["userid"]); ?></b>
					</span>
					</h4>
				<?php $dbh->displayCart($_SESSION["userid"]); ?> 
				<hr>
				<p>Sub-total <span class = "price" style ="color:black"><b>$ <?php echo number_format($dbh->cartTotal($_SESSION["userid"]), 2, '.', '') ?></b></span></p>
				<?php 
				$pre = $dbh->cartTotal($_SESSION["userid"]);
				$tax = $pre * .0725;	
				?>
				<p>Tax <span class = "price" style ="color:black"><b>$ <?php echo number_format($tax, 2, '.', '') ?></b>
				<p>Total <span class = "price" style ="color:black"><b>$ <?php $total = $pre + $tax; echo number_format($total, 2, '.', '') ?></b>
				<form method = "post">
				<input type="submit" value="Confirm Order" class="btn" name = "submission">
				</form>
				<?php
					if(isset($_POST['submission'])){
						$status = $dbh->insertOrder($_SESSION["userid"], echo number_format($total, 2, '.', ''));
						if($status == true){
							echo 'Order Successful :D </br>'; 
							echo 'Thanks for Shopping at THE Umaporium!';
				?>
							<form action="index.php" method="post">
  							<input type="submit" value="Back to Home" name= "Back to Home">
							</form> 
				<?php
						}
						else{
							echo 'Order Failed :<';
						}
					} 
				?>
				</div>
			</div>
		</div>
	</body>
			
</html>
