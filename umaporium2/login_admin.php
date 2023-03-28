<?php

if (isset($_GET['error']) && $_GET['error'] == 'invalid_password') {
  echo '<p class = "error-messsage">Invalid Password.</p>';
}
?>

    
<!DOCTYPE html>
<html>
  <head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
  <header>
      <nav>
      <?php include('./includes/navbar.php');?>
      </nav>
    </header>
    <?php

   
  

    // open up staff portal when logged in 
    if(isset($_SESSION["userid"])) {
      header("location: ./staffportal.php");
    }
    else {
    ?>
    
      <h2>ADMIN LOGIN</h2>
      <br>

    
      <!-- user login form -->
      <form action="includes/login.inc.admin.php" method="post">
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
