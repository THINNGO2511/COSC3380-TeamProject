<html>
    <?php
    session_start();

    // Check if the user is logged in
    if (isset($_SESSION["userid"])) {
        $loginButtonText = "Logout";
        $loginButtonLink = "includes/logout.inc.php?action=logout"; // replace with your account page URL
    } else {
        $loginButtonText = "Login";
        $loginButtonLink = "login_page.php"; // replace with your login page URL
    }
    ?>

    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="listings.php">Listings</a></li>
        <li><a href="cart.php">Cart</a></li>
        <!-- change this once shopping cart is created -->
        <li><a href="order.php">Order</a></li> 
        <?php if (isset($_SESSION["userid"])) { ?>
        <li><a href="account.php">Account</a></li> 
        <?php } ?>
        <li class="login-button"><a href="<?php echo $loginButtonLink ?>"><?php echo $loginButtonText ?></a></li>


    </ul>
</html>
