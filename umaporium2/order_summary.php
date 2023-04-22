<?php
session_start();
require_once('connect.php');
// Check if the user is logged in
if (!isset($_SESSION["userid"])) {
    header("Location: login_page.php");
    exit;
}

// create a new dbh object
$dbh = new Dbh();

// get the order id from the URL parameter
$orderid = $_GET['orderid'];
// call the orderData function and get the order data
$orderData = $dbh->orderData($orderid);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Order Summary</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script">
</head>
<body>
<header>
 <nav>
 <?php include('./includes/navbar.php');?>
 </nav>
</header>
	<h1>Order Summary</h1>

	<br>

	<div class="order-summary">
		<p style="font-size: 32px; margin-top: 25px; margin-bottom: 0px; font-family:'Dancing Script'; font-weight: bold; ">Order:</p>
		<p style="font-size: 18px; margin-top: 5px; margin-bottom: 0px;"> #<?php echo $orderid; ?></p>

		<p style="text-decoration: underline; margin-top: 0px; margin-bottom: 0px">__________________</p>

		<p style="font-size: 32px; margin-top: 15px; margin-bottom: 0px; font-family:'Dancing Script'; font-weight: bold; ">Order Status:</p>
		<p style="font-size: 18px; margin-top: 5px; margin-bottom: 0px;"> <?php echo $orderData[0]['orderstatus']; ?></p>

		<p style="text-decoration: underline; margin-top: 0px; margin-bottom: 0px">__________________</p>
		<br>

		<table>
			<thead>
				<tr>
					<th>Item Name</th>
					<th>Quantity</th>
					<th>Total Price</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$totalItems = 0;
				$totalPrice = 0;

				foreach ($orderData as $item) {
					if (!empty($item['p_name']) && !empty($item['quant']) && !empty($item['total'])) {
						echo '<tr>';
						echo '<td>' . $item['p_name'] . '</td>';
						echo '<td>' . $item['quant'] . '</td>';
						echo '<td>' . $item['total'] . '</td>';
						echo '</tr>';
						$totalItems += $item['quant'];
						$totalPrice += $item['total'];
					}
				}
				?>
			</tbody>
		</table>

		<p style="font-size: 18px; margin-top: 15px; margin-bottom: 0px;">Total items: <?php echo $totalItems; ?></p>
		<p style="font-size: 18px; margin-top: 5px; margin-bottom: 0px;">Total price: <?php echo $totalPrice; ?></p>
		<p style="text-decoration: underline; margin-top: 0px; margin-bottom: 0px">__________________</p>

		<script>
         function navigateToAccount() {
           window.location.href = './account.php';
         }
       </script>

       <div class="column4" onclick="navigateToAccount()" style="margin-top: 15px; margin-bottom: 15px">
		 Return
       </div>
		<br>
	</div>
	<div style="padding-top: 30px"></div>
</body>
</html>
