
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
