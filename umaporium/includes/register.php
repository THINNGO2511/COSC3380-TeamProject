<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Grabbing the data
    $fname = htmlspecialchars($_POST["fname"]);
    $lname = htmlspecialchars($_POST["lname"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    // Instantiate SignupContr class
    include "../classes/db_connect.php";
    include "../classes/signup.php";
    include "../classes/signup_contr.php";
    $signup = new SignupContr($fname, $lname, $email, $password);

    // Running error handlers and user signup
    $signup->signupUser();
    
    // redirect to home page
    header("Location: ../index.php?error=none");
}
