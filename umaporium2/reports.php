<!DOCTYPE html>
<html>
<head>
  <title>Staff Portal - Reports</title>
  <link rel="stylesheet" href="reports.css">
  <script src="reports.js"></script>
</head>
<body>
  <h1>Reports</h1>
  <button class="back-button" onclick="window.location.href='staffportal.php'">Back</button>
  <form method="GET" action="reports.php">
    <label for="report">Select a report to run:</label>
    <select name="report" id="report" onchange="toggleDateFields()">
      <option value="sales">Sales</option>
      <option value="best_sellers">Best Seller Items</option>
      <option value="best_categories">Best Seller Categories</option>
      <option value="demographics">Demographics</option>
    </select>
    <div id="date-fields">
      <label for="start_date">Start Date:</label>
      <input type="date" name="start_date">
      <label for="end_date">End Date:</label>
      <input type="date" name="end_date">
    </div>
   
    <div id="hint">Please select dates or leave them blank for all time</div>
    <button type="submit">Run Report</button>
  </form>
  <script>
    document.getElementById("report").addEventListener("change", toggleDateFields);
  </script>
</body>
</html>




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
				// display sales and calculate total sales
				$total_sales = 0;
				foreach ($results as $row) {
					$total_sales += $row['price'];
				}
				echo '<div class="report-header">
						  <h2>Sales Report</h2>';
				if ($start_date && $end_date) {
					echo '<p>Sales report for period '.$start_date.' to '.$end_date.'</p>';
				} else {
					echo '<p>Sales report for all time</p>';
				}
				echo '</div>';
				echo '<div class="total-sales-message">';
				if ($start_date && $end_date) {
					echo '<p>Total Sales for the period '.$start_date.' to '.$end_date.': $' . number_format($total_sales, 2) . '</p>';
				} else {
					echo '<p>Total Sales for all time: $' . number_format($total_sales, 2) . '</p>';
				}
				echo '</div>';
		   
				echo '<table>';
				echo '<thead><tr><th>Order ID</th><th>Price</th><th>Order Status</th><th>Order Date</th></tr></thead>';
				echo '<tbody>';
				foreach ($results as $row) {
					echo '<tr><td>' . $row['orderid'] . '</td><td>$' . $row['price'] . '</td><td>' . $row['orderstatus'] . '</td><td>' . $row['orderdate'] . '</td></tr>';
					$total_sales += $row['price'];
				}
				echo '</tbody>';
				echo '</table>';
						
				break;
				
			case 'best_sellers':
				echo '<h2>Best Seller Items Report</h2>';
				if ($start_date && $end_date) {
					echo '<p>Best seller items report for period '.$start_date.' to '.$end_date.'</p>';
				} else {
					echo '<p>Best seller items report for all time</p>';
				}
				echo '<table>';
				echo '<tr><th>Item Name</th><th>Quantity Sold</th><th>Total Sales</th></tr>';
				foreach($results as $row) {
					echo '<tr>';
					echo '<td>'.$row['p_name'].'</td>';
					echo '<td>'.$row['quantity_sold'].'</td>';
					echo '<td>$'.$row['total_sales'].'</td>';
					echo '</tr>';
				}
				echo '</table>';
				break;
				
			case 'best_categories':
				echo '<h2>Best Seller Categories Report</h2>';
				if ($start_date && $end_date) {
					echo '<p>Best seller categories report for period '.$start_date.' to '.$end_date.'</p>';
				} else {
					echo '<p>Best seller categories report for all time</p>';
				}
				echo '<table>';
				echo '<tr><th>Category Name</th><th>Quantity Sold</th></tr>';
				foreach($results as $row) {
					echo '<tr>';
					echo '<td>'.$row['category'].'</td>';
					echo '<td>'.$row['quantity_sold'].'</td>';
					echo '</tr>';
				}
				echo '</table>';
				break;
					default:
					echo '<p>No report selected.</p>';
					
					case 'demographics':
						if (count($results) > 0) {
							echo '<p>Total Customers: ' . $results[0]['total_customers'] . '</p>';
							echo '<table>';
							echo '<tr><th>Age Range</th><th>Percentage</th></tr>';
							echo '<tr><td>18-24</td><td>' . round($results[0]['age_18_24'] / $results[0]['total_customers'] * 100, 2) . '%</td></tr>';
							echo '<tr><td>25-34</td><td>' . round($results[0]['age_25_34'] / $results[0]['total_customers'] * 100, 2) . '%</td></tr>';
							echo '<tr><td>35-44</td><td>' . round($results[0]['age_35_44'] / $results[0]['total_customers'] * 100, 2) . '%</td></tr>';
							echo '<tr><td>45-54</td><td>' . round($results[0]['age_45_54'] / $results[0]['total_customers'] * 100, 2) . '%</td></tr>';
							echo '<tr><td>55+</td><td>' . round($results[0]['age_55_and_over'] / $results[0]['total_customers'] * 100, 2) . '%</td></tr>';
							echo '</table>';

							
						}
					
						break;
					}
				}
					?>
					
					</body>
					</html>