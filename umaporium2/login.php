<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
  $loggedIn = true;
} else {
  $loggedIn = false;
}

// Check if the user submitted the login form
if (isset($_POST["email"]) && isset($_POST["password"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];

  // Connect to the PostgreSQL database
  $dbconn = pg_connect("host=localhost dbname=postgres user=postgres password=Pikachuu17")
    or die("Could not connect to database");

  // Query the database for a user with the given email and password
  $result = pg_query_params($dbconn, "SELECT * FROM admin WHERE email = $1 AND password = $2", array($email, $password));
  $user = pg_fetch_assoc($result);

  // If a user was found, set the loggedIn flag in the session
  if ($user) {
    $_SESSION["loggedIn"] = true;
    $_SESSION["userId"] = $user["id"];
    $loggedIn = true;
  } else {
    $error = "Invalid email or password";
  }

  // Close the database connection
  pg_close($dbconn);
}
?>