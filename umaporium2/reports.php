<!DOCTYPE html>
<html>
<head>
	<title>Staff Portal - Reports</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Reports</h1>
	<p>Select a report to run:</p>
	<ul>
		<li><a href="reports.php?report=sales">Sales</a></li>
		<li><a href="reports.php?report=best_sellers">Best Seller Items</a></li>
		<li><a href="reports.php?report=best_categories">Best Seller Categories</a></li>
	</ul>
	<?php
	include "connect.php";
		// Check if a report has been selected
		$testObj = new Dbh();
		if(isset($_GET['report'])) {
			// Get the name of the report
			$report = $_GET['report'];
			// Call the function to run the report
			$results = $testObj->run_report($report);
			// Display the results
			switch($report) {
				case 'sales':
					echo '<h2>Sales Report</h2>';
					echo '<table>';
					echo '<tr><th>Date</th><th>Total Sales</th></tr>';
					foreach($results as $row) {
						echo '<tr>';
						echo '<td>'.$row['date'].'</td>';
						echo '<td>'.$row['total_sales'].'</td>';
						echo '</tr>';
					}
					echo '</table>';
					break;
				case 'best_sellers':
					echo '<h2>Best Seller Items Report</h2>';
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
					echo '<table>';
					echo '<tr><th>Category</th><th>Quantity Sold</th></tr>';
					foreach($results as $row) {
						echo '<tr>';
						echo '<td>'.$row['category'].'</td>';
						echo '<td>'.$row['quantity_sold'].'</td>';
						echo '</tr>';
					}
					echo '</table>';
					break;
				default:
					echo '<p>Invalid report selected.</p>';
			}
			// Add the "Return to Staff Portal" button
			echo '<button onclick="location.href=\'staffportal.php\'">Return to Staff Portal</button>';
		}
	?>
</body>
</html>
