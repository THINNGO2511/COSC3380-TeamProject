<?php
require_once(__DIR__ . '/../classes/db_connect.php');
// Connect to the database
$dbh = new Dbh();
$conn = $dbh->connect();

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if (!$user) {
  header("Location: ../login_admin.php?error=invalid_email");
  exit();
}

if (!password_verify($password, $user['password'])) {
 header("Location: ../login_admin.php?error=invalid_password");
  
 exit();
}

session_start();
$_SESSION['userid'] = $user['id'];
header("Location: ../Frankz Filez/staffportal.php");
exit();

$conn = null;
?>
