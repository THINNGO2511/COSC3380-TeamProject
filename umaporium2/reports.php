<!DOCTYPE html>
<html>
<head>
	<title>Staff Portal - Reports</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Reports</h1>
	<form method="GET" action="reports.php">
		<label for="report">Select a report to run:</label>
		<select name="report" id="report">
			<option value="sales">Sales</option>
			<option value="best_sellers">Best Seller Items</option>
			<option value="best_categories">Best Seller Categories</option>
		</select>
		<label for="start_date">Start Date:</label>
		<input type="date" name="start_date">
		<label for="end_date">End Date:</label>
		<input type="date" name="end_date">
		<button type="submit">Run Report</button>
	</form>
	<?php
	include "connect.php";
	// Check if a report has been selected
	$testObj = new Dbh();
	if(isset($_GET['report'])) {
		// Get the name of the report
		$report = $_GET['report'];
		// Get the start and end dates entered by the user
		$start_date = $_GET['start_date'];
		$end_date = $_GET['end_date'];
		// Call the function to run the report
		 $results = $testObj->run_report($report, $start_date, $end_date);
		// Display the results
		switch($report) {
			case 'sales':
				echo '<h2>Sales Report</h2>';
				// display sales and calculate total sales
				$total_sales = 0;
				echo '<p>Sales report for period '.$start_date.' to '.$end_date.'</p>';
				echo '<table>';
				echo '<thead><tr><th>Order ID</th><th>Price</th><th>Order Status</th><th>Order Date</th></tr></thead>';
				echo '<tbody>';
				foreach ($results as $row) {
					echo '<tr><td>' . $row['orderid'] . '</td><td>' . $row['price'] . '</td><td>' . $row['orderstatus'] . '</td><td>' . $row['orderdate'] . '</td></tr>';
					$total_sales += $row['price'];
				}
				echo '</tbody>';
				echo '</table>';
				echo '<p>Total Sales for the period '.$start_date.' to '.$end_date.': $' . number_format($total_sales, 2) . '</p>';
				break;
			case 'best_sellers':
				echo '<h2>Best Seller Items Report</h2>';
				echo '<p>Best seller items report for period '.$start_date.' to '.$end_date.'</p>';
				echo '<table>';
				echo '<tr><th>Item Name</th><th>Quantity Sold</th></tr>';
				foreach($results as $row) {
					echo '<tr>';
					echo '<td>'.$row['p_name'].'</td>';
					echo '<td>'.$row['quantity_sold'].'</td>';
					echo '</tr>';
				}
				echo '</table>';
				break;
				case 'best_categories':
					echo '<h2>Best Seller Categories Report</h2>';
					echo '<p>Best seller categories report for period '.$start_date.' to '.$end_date.'</p>';
					echo '<table>';
					echo '<tr><th>Category Name</th><th>Quantity Sold</th></tr>';
					foreach($results as $row) {
					echo '<tr>';
					echo '<td>'.$row['c_name'].'</td>';
					echo '<td>'.$row['quantity_sold'].'</td>';
					echo '</tr>';
					}
					echo '</table>';
					break;
					default:
					echo '<p>No report selected.</p>';
					}
					}
					?>
					
					</body>
					</html>