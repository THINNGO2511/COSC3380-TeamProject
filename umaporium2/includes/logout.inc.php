<?php

session_start();
session_unset();
session_destroy();

// Return to the front page
header("location: ../index.html?error=none");