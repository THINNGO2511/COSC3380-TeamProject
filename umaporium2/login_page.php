<!DOCTYPE html>
<html>
  <head>
    <title>Customer Login</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
  <header>
      <nav>
        <ul>
        <li><a href="index.php">Home</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="listings.html">Listings</a></li>
      <li><a href="cart.html">Cart</a></li>
        </ul>
      </nav>
    </header>
    <?php
    // for testing: redirects to "hello world" page when user is in session
    if(isset($_SESSION["userid"])) {
      header("location: index.php");
    }
    else {
    ?>
      <h2>LOGIN</h2>
      <br>
      <h6>New User? <a href="./user_registration.html">Create an account</a></h6>
      <h6>Admin login <a href="./login_admin.php">here</a></h6>
      
      <!-- user login form -->
      <form action="includes/login.inc.php" method="post">
          <div>
              <label for="email">Email: </label>
              <input type="email" name="email" id="email" placeholder="janedoe@example.com" required>
          </div>
          <div>
              <label for="password">Password: </label>
              <input type="password" name="password" id="password" placeholder="8-20 characters" required>
          </div>
          <div>
              <input type="submit" value="Login">
          </div>
      </form>

    <?php
    } ?>
    
  </body>
</html>