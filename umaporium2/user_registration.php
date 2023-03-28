<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Register New User</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <header>
      <nav>
      <?php include('./includes/navbar.php');?>
      </nav>
  </header>
    <h2>SIGN UP</h2>

    <p>Already have an account? <a href="./login_page.php">Login</a></p>
    <br>
    
    <!-- User signup form -->
    <form action="includes/register.php" method="post">
        <div>
            <label for="fname">First Name: </label>
            <input type="text" name="fname" id="fname" placeholder="first name" required>
        </div>
        <div>
            <label for="lname">Last Name: </label>
            <input type="text" name="lname" id="lname" placeholder="last name" required>
        </div>
        <div>
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" placeholder="janedoe@example.com" required>
        </div>
        <div>
            <label for="password">Create Password: </label>
            <input type="password" name="password" id="password" placeholder="8-20 characters" required>
        </div>
        <div>
            <input type="submit" value="Register!">
        </div>
    </form>


  </body>
</html>
