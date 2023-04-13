<?php
session_start();

require_once(__DIR__ . '/classes/db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION["userid"])) {
    header("Location: login_page.php");
    exit;
}

// Connect to the database
$dbh = new Dbh();
$conn = $dbh->connect();

// Get the user's information from the customer table
$query = "SELECT * FROM customer WHERE customerid = ?";
$stmt = $conn->prepare($query);
$stmt->execute(array($_SESSION["userid"]));
$userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

// Check for success message in URL query string
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<p class="success-message">Your information was updated successfully.</p>';
}


// Get the user's order history from the orders table
$query = "SELECT * FROM ordr WHERE customerid = ?";
$stmt = $conn->prepare($query);
$stmt->execute(array($_SESSION["userid"]));
$orderHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Account</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <?php include('./includes/navbar.php');?>
        </nav>
    </header>
    <main>
        <h1>Account Settings</h1>
        <form action="update_customer.php" method="POST">
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo $userInfo['namefirst']; ?>"><br>
            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo $userInfo['namelast']; ?>"><br>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $userInfo['address']; ?>"><br>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $userInfo['phonenumber']; ?>"><br>
            <input type="submit", name="submit", value="Update">
        </form>

    <h1>Order History</h1>
    <?php if (count($orderHistory) == 0) { ?>
        <p>No orders found.</p>
    <?php } else { ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total Price</th>
                    <th>Order Status/Delivery Date</th>
                    <th>Order Date</th>
                    <th>Items</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderHistory as $order) { ?>
                    <tr>
                        <td><?php echo $order['orderid']; ?></td>
                        <td><?php echo $order['price']; ?></td>
                        <td><?php echo $order['orderstatus'] ?></td>
                        <td><?php echo $order['orderdate']; ?></td>
                        <td><a href="order_summary.php?orderid=<?php echo $order['orderid']; ?>">View Items</a></td>
                    </tr>
                <?php } ?>
            </tbody>
            </table>
    <?php } ?>
</main>
</body>
</html>
