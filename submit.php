
<!DOCTYPE html>
<html>
<head>
  <title>My Form</title>
</head>
<body>
  <?php if (!empty($errors)): ?>
    <ul>
      <?php foreach ($errors as $error): ?>
        <li><?php echo $error; ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="firstName">First name:</label>
    <input type="text" name="firstName" id="firstName" value="<?php echo isset($firstName) ? htmlspecialchars($firstName) : ''; ?>"><br>
    <label for="lastName">Last name:</label>
    <input type="text" name="lastName" id="lastName" value="<?php echo isset($lastName) ? htmlspecialchars($lastName) : ''; ?>"><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>"><br>
    <label for="phoneNumber">Phone number:</label>
    <input type="tel" name="phoneNumber" id="phoneNumber" value="<?php echo isset($phoneNumber) ? htmlspecialchars($phoneNumber) : ''; ?>"><br>
    <input type="submit" value="Submit">
  </form>
</body>
</html>

<?php

$db = pg_connect(host=team8-instance-1.c9gh4dcxotkn.us-east-2.rds.amazonaws.com port=5432 dbname=postgres user=postgres password=Uma3380+);


$sql = <<<EOF
INSERT INTO CUSTOMER (namefirst, namelast, phonenumber, email)
VALUES('$_post[firstName]', '$_post[lastName]', '$_post[phoneNumber]', '$_post[email]');
EOF;

$ret = pg_query($db, $sql);
if(!$ret) {
  echo pg_last_error($db);
  exit;
}

pg_close($db);
?>
