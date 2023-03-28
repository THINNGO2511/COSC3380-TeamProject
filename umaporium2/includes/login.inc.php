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
        header("location: ../index.php");
}

?>
