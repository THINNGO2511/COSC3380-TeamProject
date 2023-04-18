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
    $age = $_POST['age'];

    $query = "UPDATE customer SET ";

    if (!empty($firstname)) {
        $query .= "namefirst = ?, ";
    }

    if (!empty($lastname)) {
        $query .= "namelast = ?, ";
    }

    if (!empty($address)) {
        $query .= "address = ?, ";
    }

    if (!empty($phone)) {
        $query .= "phonenumber = ?, ";
    }

    if (!empty($age)) {
        $query .= "age = ?, ";
    }

    // Remove the last comma and space from the query string
    $query = rtrim($query, ', ');

    $query .= " WHERE customerid = ?";
    $stmt = $conn->prepare($query);

    // Bind the parameters based on which fields were provided in the form
    $i = 1;
    if (!empty($firstname)) {
        $stmt->bindParam($i, $firstname);
        $i++;
    }

    if (!empty($lastname)) {
        $stmt->bindParam($i, $lastname);
        $i++;
    }

    if (!empty($address)) {
        $stmt->bindParam($i, $address);
        $i++;
    }

    if (!empty($phone)) {
        $stmt->bindParam($i, $phone);
        $i++;
    }

    if (!empty($age)) {
        $stmt->bindParam($i, $age);
        $i++;
    }

    $stmt->bindParam($i, $_SESSION["userid"]);
    $stmt->execute();

    // Redirect back to account.php after updating the information and include success flag
    header("Location: account.php?success=1");
    exit;
} else {
    echo "Form was not submitted.";
}
?>
