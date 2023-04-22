<html>
<head>
<title>Staff Portal</title>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script">
</head>
<body>

<nav>
	<h1 style="color:#fff;font-size: 2.25em; font-family: 'Dancing Script'; margin: 0">
		Cougarporium
	</h1>
</nav>

<h2 style="font-family:'Dancing Script'; font-size: 2.5em"><center>Staff Portal</center></h2>

<script>
	function navigateToLogOut() {
		window.location.href = 'includes/logout.inc.php?action=logout';
	}
</script>

<script>
	function navigateToItemAdd() {
		window.location.href = 'itemadd.php';
	}
</script>

<script>
	function navigateToViewInventory() {
	window.location.href = 'viewinventory.php';
	}
</script>

<script>
	function navigateToEditItem() {
		window.location.href = 'itemedit.php';
	}
</script>

<script>
	function navigateToEditInventory() {
		window.location.href = 'invedit.php';
	}
</script>

<script>
	function navigateToReports() {
		window.location.href = 'reports.php';
	}
</script>

<div class="staff-btn-gr">
	<div class="column4" onclick="navigateToItemAdd()" style="margin-top: 14px">
		Add Item
	</div>

	<div class="column4" onclick="navigateToViewInventory()">
		View Inventory
	</div>

	<div class="column4" onclick="navigateToEditItem()">
		Edit Item
	</div>

	<div class="column4" onclick="navigateToEditInventory()">
		Edit Inventory
	</div>

	<div class="column4" onclick="navigateToReports()">
		Reports
	</div>

	<div class="column4" onclick="navigateToLogOut()" style="background-color: rgb(89, 89, 89) ; color: #fff">
		Log out
	</div>
	
</div>

</body>
</html>
