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
</head>
<body>
<header>
 <nav>
 <?php include('./includes/navbar.php');?>
 </nav>
</header>
<h1>Order Summary: Order #<?php echo $orderid; ?></h1>
<h2>Order Status: <?php echo $orderData[0]['orderstatus']; ?></h1>
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

	<p>Total items: <?php echo $totalItems; ?></p>
	<p>Total price: <?php echo $totalPrice; ?></p>

</body>
</html>
