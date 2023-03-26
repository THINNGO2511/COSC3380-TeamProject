<html>
<head>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">
  <h1>Umaporium Staff - Web Portal</h1>
  <form action="../includes/logout.inc.php" method="get" class="logout-form">
    <button type="submit" name="logout-submit">Logout</button>
    <input type="hidden" name="action" value="logout">
  </form>
</div>

  <br>

<div class="column3">
<form action="itemadd.php">
	<button style="height:10%;width:100%"> Add Item </button>
</form>
</div>

<div class="column3">
<form action="viewinventory.php">
	<button style="height:10%;width:100%"> View Inventory </button>
</form>
</div>

<div class="column3">
<form action="itemedit.php">
	<button style="height:10%;width:100%"> Edit Item </button>
</form>
</div>

</body>
</html>
