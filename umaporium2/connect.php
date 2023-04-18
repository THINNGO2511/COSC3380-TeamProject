<?php

class Dbh {

	
	protected function connect() {
        // Database credentials
        $host = "team8uma.postgres.database.azure.com";
        $dbname = "postgres";
        $dbuser = "postgres@team8uma";
        $dbpass = "Uma3380+";

        try {
            // Attempt to connect to the database
		    $dbh = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
            return $dbh;
        } catch (PDOException $e) {
            print "Error!: ". $e->getMessage() . "</br>";
            die();
        }
    }
	
	public function buildListings() {?>
		<table>
		<tr>
			<th>Product_ID</th>
			<th>Name</th>
			<th>Color</th>
			<th>Category</th>
			<th>Description</th>
			<th>Brand</th>
			<th>Size</th>
			<th>Price</th>
			<?php if (isset($_SESSION["userid"])){echo "<th></th>";}?>
			
		</tr>
		<?php
	}

	public function listings($keyword='', $sort='') {
		$sql = "SELECT * FROM product";
		$sql .= $this->search($keyword, $sort);
		$stmt = $this->connect()->query($sql);
		$numResults = $stmt->rowCount();

		if ($numResults == 0) {
			echo '<h2 style="color:black;text-align:center">No Results...</h2>';
		}

		else
		{	echo '<h2 style="color:grey;text-align:right;">'.$numResults.' results found.</h2><br>';

			$this->buildListings();
			while($row = $stmt->fetch()) {
				$imgPath = '<img src="./product_img/pid_'.$row['p_id'].'.png" alt="'.$row['description'].'" style="width:100px;height:100px;">';
			echo '<tr>';
			echo '<td>' . $row['p_id'] . '</th>';
			echo '<td>' . $row['p_name'] .'<br>'.$imgPath. '</th>';
			echo '<td>' . $row['color'] . '</th>';
			echo '<td>' . $row['category'] . '</th>';
			echo '<td>' . $row['description'] . '</th>';
			echo '<td>' . $row['brand'] . '</th>';
			echo '<td>' . $row['c_sizes'] . '</th>';
			echo '<td>$' . $row['price'] . '</th>';
			if (isset($_SESSION["userid"])) {
				echo '<td>';
				echo '<form method="post">';
				echo '<button name="atc" class="button" value='.$row['p_id'].' type="submit">Add to Cart</button>';
				echo '</form>';
				echo '</td>';
			}
			echo '</tr>';	
			}
			echo '</table>';
			if ($_POST['atc']){
				$id = (int)$_POST['atc'];
				$uid = (int)$_SESSION['userid'];
				$this->atc($id, $uid);
			}
		}
		
	}

	public function search($keyword, $sort){
		if ($keyword=='' && $sort=='') {
			return '';
		}
		elseif ($keyword!='') {
			$sql = " WHERE UPPER(p_name) LIKE UPPER('%$keyword%') or UPPER(color) LIKE UPPER('%$keyword%') or UPPER(category) LIKE UPPER('%$keyword%') or UPPER(brand) LIKE UPPER('%$keyword%')";
			$sql .= $this->sortBy($sort);
			}
		else {
			$sql = $this->sortBy($sort);
		}
		return $sql;
	}

	public function sortBy($sort) {
		switch ($sort) {
			case 'new':
				$sql_str = " ORDER BY p_id DESC;";
				break;
			
			case 'price-LowHi':
				$sql_str = " ORDER BY price ASC;";
				break;
			
			
			case 'price-HiLow':
				$sql_str = " ORDER BY price DESC;";
				break;
		
			case 'bestseller':
				// $sql_str = $conn->prepare("SELECT product.p_name, COUNT(*) AS quantity_sold
				// FROM ordr
				// INNER JOIN product ON product.p_id = ANY(ordr.p_id_list)
				// GROUP BY product.p_id
				// ORDER BY quantity_sold DESC
				// break;
			
			default:
				$sql_str = "";
				break;
		}
		return $sql_str;
	}

	public function categoryOpt() {
		$query = "SELECT DISTINCT category FROM product ORDER BY category;";
		$stmt = $this->connect()->query($query);

		while($row = $stmt->fetch()) {
			echo '<option value="'.$row["category"].'">';
		}
	}

	public function brandOpt() {
		$query = "SELECT DISTINCT brand FROM product ORDER BY brand;";
		$stmt = $this->connect()->query($query);

		while($row = $stmt->fetch()) {
			echo '<option value="'.$row["brand"].'">';
		}
	}

    public function colorOpt() {
		$query = "SELECT DISTINCT color FROM product ORDER BY color;";
		$stmt = $this->connect()->query($query);

		while($row = $stmt->fetch()) {
			echo '<option value="'.$row["color"].'">';
		}
	}

	public function insertProduct($name, $color, $category, $subcategory, $description, $brand, $size, $price) {
		$sql = 'INSERT INTO product(p_name, color, category, subcategory, description, brand, c_sizes, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?);';

		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$name, $color, $category, $subcategory, $description, $brand, $size, $price]);

	}

	public function getNextPID() {
		$query = "SELECT MAX(p_id) FROM product;";
		$stmt = $this->connect()->query($query);
		$p_id = $stmt->fetch()['max'];
		return $p_id+1;
	}

	public function viewinventory() {
		$sql = 'SELECT * FROM inventory;';
		$stmt = $this->connect()->query($sql);

		while($row = $stmt->fetch()) {
			echo '<tr>';
			echo '<td>' . $row['itemthreshold'] . '</th>';
			echo '<td>' . $row['brand'] . '</th>';
			echo '<td>' . $row['clothingline'] . '</th>';
			echo '<td>' . $row['productid'] . '</th>';
			echo '<td>' . $row['o_stock'] . '</th>';
			echo '</tr>';
		}

	}


	public function itemedit($type, $keyword, $pid) {
		$sql1 = 'UPDATE product SET ';
		$sql2 = '=? WHERE p_id=?';
		$sql = $sql1.$type.$sql2;
		
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$keyword, $pid]);
	}

	public function invedit($type, $keyword, $pid) {
		$sql1 = 'UPDATE inventory SET ';
		$sql2 = '=? WHERE productid=?';
		$sql = $sql1.$type.$sql2;

		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$keyword, $pid]);
	}

	public function displayCart($c_id){
		$query = 'SELECT * FROM shoppingcart WHERE customerid = ?';
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$c_id]);
		$Array = $stmt->fetch(PDO::FETCH_ASSOC);
		$productString = substr($Array['p_id_list'], 1, -1);
		$intArray = explode(',', $productString);
		$_SESSION['cartArray'] = $intArray;
		?>
		<form action="cart.php" method="post" id = "cart">
		<?php foreach($intArray as $p_id){ ?> 
				<label for="quantity">Quantity:</label>
				<select id=	"<?php echo $p_id;?>" name="<?php echo $p_id;?>">  
				<option value="1" selected> 1 </option>
				<option value="2"> 2 </option>
				<option value="3"> 3 </option>
				<option value="4"> 4 </option>
				<option value="5"> 5 </option>
				</select>
			<?php $this->displayProduct($p_id);
		}
		?>

		<button name="submit" class="btn" type="submit">Checkout</button>
		</form>
		<?php
	}
	
	public function displayOrder($c_id){
		$query = 'SELECT array_to_json(p_id_list) AS productlist FROM shoppingcart WHERE customerid = ?';
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$c_id]);
		$prodArray = $stmt->fetch();
		$intArray = json_decode($prodArray[0]);
		foreach($intArray as $p_id){ 
			$this->displayProductForOrder($p_id, $c_id);
		}
	}
	
	public function addQuantity($cart){
		$query2 = "('";
		$last = end($cart);
		foreach($cart as $p_id){
			$quantity = $_POST[$p_id];
			if($p_id == $last){$query2 .= '"'.$p_id.'"=>"'.$quantity.'"'; }
			else{$query2 .= '"'.$p_id.'"=>"'.$quantity.'",'; } 
			$query = "UPDATE shoppingcart SET cart ="; 
			$query3 = "') WHERE customerid = ? ";
			$stmt = $this->connect()->prepare($query.$query2.$query3);
			$stmt->execute([$_SESSION["userid"]]);
		}
	}
	
	public function displayProduct($p_id){
		$sql = 'SELECT p_name, price FROM product WHERE p_id = ?';
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$p_id]);
		$product = $stmt->fetch();
		echo '<p><a>'.$product['p_name'].'</a> <span class ="price">'.$product['price'].'</span></p>';
	}
	
	public function displayProductForOrder($p_id, $c_id){
		$sql = 'SELECT * FROM product WHERE p_id = ?';
		$quant = 'SELECT cart->? AS quantity FROM shoppingcart WHERE customerid = ?';
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$p_id]);
		$product = $stmt->fetch();
		$stmt = $this->connect()->prepare($quant);
		$stmt->execute([$p_id, $c_id]);
		$quantity = $stmt->fetch();
		echo '<p><a style="display: inline-block;"> '.$quantity['quantity'].' x '.$product['p_name'].'</a> <span class ="price">'.$product['price'].'</span><br>';
		$itemsPrice = $quantity['quantity'] * $product['price'];
		echo '<span style="display: block; margin-top: 5px;">Items Total: '.number_format($itemsPrice, 2, '.', '').'</span></p>';
	}
	
	public function cartCount($c_id){
		$sql = 'SELECT ARRAY_LENGTH(p_id_list, 1) FROM shoppingcart WHERE customerid = ?';
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$c_id]);
		$count = $stmt->fetch();
		return $count['array_length'];
	}

	public function cartTotal($c_id){
		$query = 'SELECT array_to_json(p_id_list) AS productlist FROM shoppingcart WHERE customerid = ?';
		$quant = 'SELECT cart->? AS quantity FROM shoppingcart WHERE customerid = ?';
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$c_id]);
		$prodArray = $stmt->fetch();
		$intArray = json_decode($prodArray[0]);
		$total = 0.00;
		$stmt = $this->connect()->prepare($quant);
		foreach($intArray as $p_id){
			$stmt->execute([$p_id, $c_id]);
			$quantity = $stmt->fetch();
			$total += $this->itemPrice($p_id) * intval($quantity['quantity']);
		}
		return $total;
	}

	public function itemPrice($p_id){
		$query = 'SELECT * FROM product WHERE p_id = ?';
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$p_id]);
		$product = $stmt->fetch();
		return $product['price'];
	}

	public function insertOrder($c_id, $price){
		$sql = 'SELECT * FROM shoppingcart WHERE customerid = ?';
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$c_id]);
		$Array = $stmt->fetch(PDO::FETCH_ASSOC);
		$query = 'INSERT INTO ordr(price, p_id_list, customerid) VALUES (?, ?, ?);';
		$stmt = $this->connect()->prepare($query);
		return $stmt->execute([$price,$Array['p_id_list'],$c_id]);
	}
	
	public function display($uid) {
		$sql1 = 'SELECT namefirst FROM customer WHERE customerid=';
		$sql = $sql1.$uid;
		$stmt = $this->connect()->query($sql);
		while ($row = $stmt->fetch()) {
			echo '<h1>Welcome to the Cougarporium, ' . $row['namefirst'] . '!</h1>';
		}
	}

	public function displaylist() {
		$sql = 'SELECT * FROM product ORDER BY p_id DESC LIMIT 5';
		$stmt = $this->connect()->query($sql);

		echo "<table style='margin-left:auto;margin-right:auto;width:97%;table-layout:fixed;border: 2px solid black';>";

		while($row = $stmt->fetch()) {
			$imgPath = '<img src="./product_img/pid_'.$row['p_id'].'.png" alt="'.$row['description'].'" style="width:50px;height:50px;">';
			echo '<tr style="margin-left:auto;margin-right:auto;width:100%;border: 2px solid black";>';
			echo '<td style="margin-left:auto;margin-right:auto;width:51px;border: 2px solid black";>' . $imgPath . '</th>';
			echo '<td style="margin-left:auto;margin-right:auto;width:100%;border: 2px solid black";>' . $row['p_name'] . '</th>';
			echo '<td style="margin-left:auto;margin-right:auto;width:100%;border: 2px solid black";>' . $row['brand'] . '</th>';
			echo '<td style="margin-left:auto;margin-right:auto;width:100%;border: 2px solid black";>$' . $row['price'] . '</th>';
			echo '</tr>';
		}

		echo "</table>";
	}
	
	public function atc($id, $uid) {
		if ($id == 0) {
			echo "";
		} else {
			$sql = 'UPDATE shoppingcart SET p_id_list = array_append(p_id_list, ?) WHERE customerid=?';
  			$stmt = $this->connect()->prepare($sql);
  			$stmt->execute([$id, $uid]);
		
			echo "Added successfully to shopping cart.";
		}
	} 

	public function emptyCart($uid) {
		$sql = "UPDATE shoppingcart SET p_id_list = '{}' WHERE customerid=?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$uid]);
	}


	public function run_report($report, $start_date = null, $end_date = null, $category = null) {
		// Connect to the database
		$conn = $this->connect();
	
		// Run the appropriate query based on the report name
		switch ($report) {
			case 'sales':
				$sql = "SELECT * FROM ordr";
				if ($start_date && $end_date) {
					$sql .= " WHERE orderdate BETWEEN :start_date AND :end_date";
				}
				$stmt = $conn->prepare($sql);
				if ($start_date && $end_date) {
					$stmt->bindParam(':start_date', $start_date);
					$stmt->bindParam(':end_date', $end_date);
				}
				break;
				case 'best_sellers':
					$sql = "SELECT product.p_name, COUNT(*) AS quantity_sold, SUM(product.price) AS total_sales
							FROM ordr
							INNER JOIN product ON product.p_id = ANY(ordr.p_id_list)";
					if ($start_date && $end_date) {
						$sql .= " WHERE orderdate BETWEEN :start_date AND :end_date";
					}
					$sql .= " GROUP BY product.p_id ORDER BY quantity_sold DESC";
					$stmt = $conn->prepare($sql);
					if ($start_date && $end_date) {
						$stmt->bindParam(':start_date', $start_date);
						$stmt->bindParam(':end_date', $end_date);
					}
					break;
				
			case 'best_categories':
				$sql = "SELECT product.category, COUNT(*) AS quantity_sold
						FROM ordr
						INNER JOIN product ON product.p_id = ANY(ordr.p_id_list)";
				if ($start_date && $end_date) {
					$sql .= " WHERE orderdate BETWEEN :start_date AND :end_date";
				}
				$sql .= " GROUP BY product.category ORDER BY quantity_sold DESC";
				$stmt = $conn->prepare($sql);
				if ($start_date && $end_date) {
					$stmt->bindParam(':start_date', $start_date);
					$stmt->bindParam(':end_date', $end_date);
				}
				break;
				case 'demographics':
					$stmt = $conn->prepare("SELECT 
					COUNT(DISTINCT customerid) AS total_customers,
					COUNT(DISTINCT CASE WHEN age BETWEEN 18 AND 24 THEN customerid END) AS age_18_24,
					COUNT(DISTINCT CASE WHEN age BETWEEN 25 AND 34 THEN customerid END) AS age_25_34,
					COUNT(DISTINCT CASE WHEN age BETWEEN 35 AND 44 THEN customerid END) AS age_35_44,
					COUNT(DISTINCT CASE WHEN age BETWEEN 45 AND 54 THEN customerid END) AS age_45_54,
					COUNT(DISTINCT CASE WHEN age >= 55 THEN customerid END) AS age_55_and_over
				FROM 
					customer
				");
				
					break;
			default:
				die("Invalid report selected.");
		}
		
		// Execute the query and fetch the results as an array of associative arrays
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Close the database connection
		$conn = null;
		// Return the results
		return $results;
	}
	

	
	public function orderData($orderid){
		// Retrieve some data about the order(date, status, total), stuff it into a key-value array, and return said array.
		$sql = 'SELECT orderdate, orderstatus, price FROM ordr WHERE orderid = ?';
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$orderid]);
		$order = $stmt->fetch();
		$meta = array('date' => $order['orderdate'], 'status' => $order['orderstatus'], 'price' => $order['price']);
		return $meta;
	}

	public function getOrder($uid, $orderid) {
		$query = 'SELECT * FROM ordr WHERE customerid = ? AND orderid = ?';
		$stmt = $this->connect()->prepare($query);
		
		$stmt->execute([$uid, $orderid]);
		$Array = $stmt->fetch(PDO::FETCH_ASSOC);
		$productString = substr($Array['p_id_list'], 1, -1);
		$intArray = explode(',', $productString);
		foreach($intArray as $p_id){ 
		// Loop to retrieve and display data of every product within the order
		$this->displayOrderData($p_id);
		}

	
	}

	public function orderRetrievalError($uid, $orderid){
		//Error handler to ensure authorized user access of orders
		$sql = 'SELECT COUNT(*) AS count FROM ordr WHERE customerid = ? AND orderid = ?';
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$uid, $orderid]);
		$results = $stmt->fetch();
		if ($results['count'] == 0) {
			return true;
		}
		return	false;
	}

	public function displayOrderData($p_id){
		// Display product data
		$sql = 'SELECT brand, p_name, c_sizes, price FROM product WHERE p_id = ?';
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$p_id]);
		$product = $stmt->fetch();
		echo '<h3>'.$product['brand'].' - '.$product['p_name'].'('.$product['c_sizes'].')'.' <span>&emsp;$'.$product['price'].'</span></h3>';
	}
}




?>
