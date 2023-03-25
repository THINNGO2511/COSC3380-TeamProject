<?php
session_start();

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
    <title>My First Webpage</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="inventory.html">Inventory</a></li>
                <li><a href="sales.html">Sales</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li class="login-button"><a href="<?php echo $loginButtonLink ?>"><?php echo $loginButtonText ?></a></li>
            </ul>
        </nav>
    </header>
    <main>
        <!-- Add content here -->
    </main>
    <footer>
        <!-- Add footer content here -->
    </footer>
</body>
</html>