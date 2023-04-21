<!DOCTYPE html>
<html>
 <head>
   <title>Login Portal</title>
   <link rel="stylesheet" href="styles.css">
 </head>
 <body>
 <header>
     <nav>
     <?php include('./includes/navbar.php');?>
     </nav>
   </header>
  
   <?php
   if(isset($_SESSION["userid"])) {
     header("location: index.php");
   }
   else {
   ?>
     <h2 style="color: black ; padding-top: 20px;"><center>LOGIN</center></h2>
     <br>


   <div class="login-form">
       <script>
         function navigateToNewUser() {
           window.location.href = './user_registration.php';
         }
       </script>


       <script>
         function navigateToStaffPortal() {
           window.location.href = './login_admin.php';
         }
       </script>


       <div class="column4" onclick="navigateToNewUser()" style="margin-top: 25px; margin-bottom: 5px">
         New User
       </div>


       <div class="column4" onclick="navigateToStaffPortal()" style="margin-top: 15px; margin-bottom: 5px">
         Staff Portal
       </div>
      
       <!-- ********** user login form ********* -->
       <form action="includes/login.inc.php" method="post" class="center-form">
         <p style="text-decoration: underline; margin-top: 7px; margin-bottom: 5px">_______________</p>
         <p style="font-size: 17px; text-decoration: underline; margin-top: 10px; margin-bottom: 5px">Returning User</p>


           <div style="display: flex; flex-direction: column; align-items: center;">
               <label for="email">Email:</label>
               <input type="email" name="email" id="email" placeholder="janedoe@example.com" required>
           </div>
           <div style="padding-top: 10px"></div>
           <div style="display: flex; flex-direction: column; align-items: center;">
               <label for="password">Password: </label>
               <input type="password" name="password" id="password" placeholder="8-20 characters" required>
           </div>
           <div style="padding-bottom: 25px; padding-top: 10px;">
               <input type="submit" value="Login">
           </div>
       </form>
   </div>
  
  
   <?php
 } ?>


</body>
</html>



