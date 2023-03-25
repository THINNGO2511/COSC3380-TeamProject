<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Grabbing the data
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    // Instantiate SignupContr class
    include "../classes/db_connect.php";
    include "../classes/login.php";
    include "../classes/login_contr.php";
    $login = new LoginContr($email, $password);

    // Running error handlers and user signup
    $login->LoginUser();
    
    // redirect to "hello world"
    header("location: ../index.html");
}
/*else {
    //redirect to home page
    header("Location: ../index.php?error=posterror");
}*/

?>