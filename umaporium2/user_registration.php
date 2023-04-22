<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Register New User</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script">
  </head>
  <body>
    <header>
      <nav>
      <?php include('./includes/navbar.php');?>
      </nav>
  </header>

  <h2 style="font-family:'Dancing Script'; font-size: 2.5em; color: black;"><center>Register</center></h2>
    
    <!-- User signup form -->
    <div class="login-form">
    <form action="includes/register.php" method="post" class="center-form">
        <p style="font-size: 24px; margin-top: 20px; margin-bottom: 10px; font-family:'Dancing Script'; ">Join us!</p>
        <div style="display: flex; flex-direction: column; align-items: center;">
            <label for="fname">First Name: </label>
            <input type="text" name="fname" id="fname" placeholder="first name" required>
        </div>
        <div style="padding-top: 10px"></div>
        <div style="display: flex; flex-direction: column; align-items: center;">
            <label for="lname">Last Name: </label>
            <input type="text" name="lname" id="lname" placeholder="last name" required>
        </div>
        <div style="padding-top: 10px"></div>
        <div style="display: flex; flex-direction: column; align-items: center;">
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" placeholder="janedoe@example.com" required>
        </div>
        <div style="padding-top: 10px"></div>
        <div style="display: flex; flex-direction: column; align-items: center;">
            <label for="password">Create Password: </label>
            <input type="password" name="password" id="password" placeholder="8-20 characters" required>
        </div>
        <div style="padding-bottom: 30px; padding-top: 20px;">
            <input type="submit" value="Register!" style="transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#e89890'; this.style.color='white';" onmouseout="this.style.backgroundColor=''; this.style.color='';">
        </div>
    </form>


  </body>
</html>
