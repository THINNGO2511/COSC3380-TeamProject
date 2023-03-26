<?php
session_start();

require_once(__DIR__ . '/classes/db_connect.php');

// Connect to the database
$dbh = new Dbh();
$conn = $dbh->connect();

// Update the customer information
if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $query = "UPDATE customer SET namefirst = ?, namelast = ?, address = ?, phonenumber = ? WHERE customerid = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute(array($firstname, $lastname, $address, $phone, $_SESSION["userid"]));
    
    // Redirect back to account.php after updating the information and include success flag
    header("Location: account.php?success=1");
exit;
} else {
    echo "Form was not submitted.";
}
?>
