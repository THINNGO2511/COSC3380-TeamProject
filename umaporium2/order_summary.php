<?php
session_start();
require_once(__DIR__ . '/connect.php');
$dbh = new Dbh();
$orderid = $_GET['orderid'];
$meta = $dbh->orderData($orderid);

?>

<html>
<link rel="stylesheet" href="styles.css">
<?php 
if (!$dbh->orderRetrievalError($_SESSION["userid"], $orderid)) { ?>
<head>
<title><?php echo "ORDER #$orderid" ?></title>
</head>
<body>
    <header>
  <nav>
  <?php include('./includes/navbar.php');?>
  </nav>
    </header>	
    <h1>Order Summary: <u><?php echo "ORDER #$orderid" ?></u></h1>
    <br>
    <h3>Status: <?php echo $meta['status'] ?></h3>
    <h3>Order Date: <?php echo $meta['date'] ?></h3>
    <br>
    <div style="text-align:center">
        <h2><u>Items</u></h2>
        <?php $dbh->getOrder($_SESSION["userid"], $orderid) ?>
        <b><b>
    </div>
    <div style="text-align: right; padding-right:20em;">
    <h3>Total: $<?php echo $meta['price'];?></h3>
    </div>
</body>
<?php }


else { //user unathorized?>
  <head>
  <title>ERROR</title>
  </head>
  <body>
    <header>
    <nav>
    <?php include('./includes/navbar.php');?>
    </nav>
    </header>	
    <br><br>
    <h1>ERROR!</h1><br>
    <h1>Hmmm... Looks like this order does not exist under your account.</h1>
    <div style="text-align:center">
    <button onclick="window.location.href='account.php'">Back to My Account</button>
    </div>
  </body>
<?php } ?>

</html>