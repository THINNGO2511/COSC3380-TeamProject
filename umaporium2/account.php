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
$query = "SELECT * FROM ordr WHERE customerid = ?
ORDER BY orderid DESC"; 
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script">
</head>
<body>
    <header>
        <nav>
            <?php include('./includes/navbar.php');?>
        </nav>
    </header>
    <main>
    <h2 style="font-size: 2em; color: black;"><center>SETTINGS</center></h2>
    <div class="login-form">
        <form action="update_customer.php" method="POST" class="center-form">
            <p style="font-size: 30px; margin-top: 20px; margin-bottom: 10px; font-family:'Dancing Script'; ">Account</p>

            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo $userInfo['namefirst']; ?>"><br>
            
            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo $userInfo['namelast']; ?>"><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $userInfo['address']; ?>"><br>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $userInfo['phonenumber']; ?>"><br>

            <label for="age">Age:</label>
            <input type="text" id="age" name="age" value="<?php echo $userInfo['age']; ?>"><br>

            <div style="padding-bottom: 30px;">
                <input type="submit", name="submit", value="Update">
            </div>
        </form>
    </div>

    <?php if (count($orderHistory) == 0) { ?>
        <p>No orders found.</p>
        <?php } else { ?>
        
        <div style="width: 50%; border-radius: 24px; border: 3.5px solid black; display: flex; justify-content: center; align-items: center; flex-direction: column; background-color: white; margin: 50px auto;">
        <p style="font-size: 30px; margin-top: 20px; margin-bottom: 10px; font-family:'Dancing Script'; ">Order History</p>
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
                        <td><?php echo '$'.$order['price']; ?></td>
                        <td><?php echo $order['orderstatus'] ?></td>
                        <td><?php echo $order['orderdate']; ?></td>
                        <td><a href="order_summary.php?orderid=<?php echo $order['orderid']; ?>">View Items</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>
        </div>

    <?php } ?>

    <footer>
        <nav>
        <p style="color:#fff;">
            <a href="https://github.com/THINNGO2511/COSC3380-TeamProject" target="_blank" class="team-link">A Team 8 Project</a>. Copyrighted COSC 3380, UH, 2023.
        </p>
        </nav>
    </footer>

    </main>
</body>
</html>
