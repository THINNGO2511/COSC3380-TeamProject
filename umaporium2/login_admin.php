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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script">
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
    
    <!-- <h2 style="color: black ; padding-top: 20px;"><center>STAFF LOGIN</center></h2> -->
    <h2 style="font-family:'Dancing Script'; font-size: 2.5em"><center>Staff Portal</center></h2>

      <div class="login-form">
      <!-- user login form -->
      <form action="includes/login.inc.admin.php" method="post" class="center-form">
      <p style="font-size: 24px; margin-top: 25px; margin-bottom: 10px; font-family:'Dancing Script'; ">How's your day?</p>
          <div style="display: flex; flex-direction: column; align-items: center;">
              <label for="email">Email: </label>
              <input type="email" name="email" id="email" placeholder="janedoe@example.com" required>
          </div>
          <div style="padding-top: 10px"></div>
          <div style="display: flex; flex-direction: column; align-items: center;">
              <label for="password">Password: </label>
              <input type="password" name="password" id="password" placeholder="8-20 characters" required>
          </div>
          <div style="padding-bottom: 30px; padding-top: 20px;">
              <input type="submit" value="Login">
          </div>
      </form>
      </div>
    <?php
    } ?>
    
  </body>
</html>
