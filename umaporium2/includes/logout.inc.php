<?php
// Check if the action parameter is set and equal to "logout"
if (isset($_GET["action"]) && $_GET["action"] == "logout") {
    // End the session
    session_start();
    session_destroy();

    // Redirect to the index.php file
    header("Location: ../index.php");
    exit;
}
?>
