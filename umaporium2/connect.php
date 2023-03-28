<?php

class Dbh {

	protected function connect() {
        // Database credentials
        $host = "team8-instance-1.c9gh4dcxotkn.us-east-2.rds.amazonaws.com";
        $dbname = "postgres";
        $dbuser = "postgres";
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
	
	public function listings() {
		$sql = 'SELECT * FROM product;';
		$stmt = $this->connect()->query($sql);

		while($row = $stmt->fetch()) {
			echo '<tr>';
			echo '<td>' . $row['p_id'] . '</th>';
			echo '<td>' . $row['p_name'] . '</th>';
			echo '<td>' . $row['color'] . '</th>';
			echo '<td>' . $row['category'] . '</th>';
			echo '<td>' . $row['description'] . '</th>';
			echo '<td>' . $row['brand'] . '</th>';
			echo '<td>' . $row['c_sizes'] . '</th>';
			echo '<td>' . $row['price'] . '</th>';
			echo '<td>';
			echo '<form method="post">';
			echo '<button name="atc" class="button" value='.$row['p_id'].' type="submit">Add to Cart</button>';
			echo '</form>';
			echo '</td>';
			echo '</tr>';
			
				
		}
		if ($_POST['atc']){
			$id = (int)$_POST['atc'];
			$uid = (int)$_SESSION['userid'];
			$stamt = $this->atc($id, $uid);
		}
	}

	public function search($keyword){
		$sql = "SELECT * FROM product WHERE p_name LIKE '%$keyword%' or color LIKE '%$keyword%' or category LIKE '%$keyword%' or brand LIKE '%$keyword%'";

		$stmt = $this->connect()->query($sql);
		

		while($row = $stmt->fetch()) {
			echo '<tr>';
			echo '<td>' . $row['p_id'] . '</th>';
			echo '<td>' . $row['p_name'] . '</th>';
			echo '<td>' . $row['color'] . '</th>';
			echo '<td>' . $row['category'] . '</th>';
			echo '<td>' . $row['description'] . '</th>';
			echo '<td>' . $row['brand'] . '</th>';
			echo '<td>' . $row['c_sizes'] . '</th>';
			echo '<td>' . $row['price'] . '</th>';
			echo '<td>';
			echo '<form method="post">';
			echo '<button name="atc" class="button" value='.$row['p_id'].' type="submit">Add to Cart</button>';
			echo '</form>';
			echo '</td>';
			echo '</tr>';	
		}
		if ($_POST['atc']){
			$id = (int)$_POST['atc'];
			$uid = (int)$_SESSION['userid'];
			$stamt = $this->atc($id, $uid);
		}


	}

	public function insertproduct($name, $color, $category, $subcategory, $description, $brand, $size, $price) {
		$sql = 'INSERT INTO product(p_name, color, category, subcategory, description, brand, c_sizes, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?);';

		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$name, $color, $category, $subcategory, $description, $brand, $size, $price]);

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
		//foreach (array_combine($p_id, $quantity) as $p_id => $quantity) for when we have the quantities figured out fuck me 
		foreach($intArray as $p_id){ 
		$this->displayProduct($p_id);
			}
	}

	public function displayProduct($p_id){
		$sql = 'SELECT p_name, price FROM product WHERE p_id = ?';
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$p_id]);
		$product = $stmt->fetch();
		echo '<p><a>'.$product['p_name'].'</a> <span class ="price">'.$product['price'].'</span></p>';
	}

	public function cartCount($c_id){
		$sql = 'SELECT ARRAY_LENGTH(p_id_list, 1) FROM shoppingcart WHERE customerid = ?';
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$c_id]);
		$count = $stmt->fetch();
		return $count;
	}

	public function cartTotal($c_id){
		$query = 'SELECT * FROM shoppingcart WHERE customerid = ?';
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$c_id]);
		$Array = $stmt->fetch(PDO::FETCH_ASSOC);
		$productString = substr($Array['p_id_list'], 1, -1);
		$intArray = explode(',', $productString);
		$total = 0.00;
		foreach($intArray as $p_id){
		$total += $this->itemPrice($p_id);
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
			echo '<h1>Welcome to the Umaporium, ' . $row['namefirst'] . '!</h1>';
		}
	}

	public function displaylist() {
		$sql = 'SELECT * FROM product ORDER BY p_id ASC LIMIT 5';
		$stmt = $this->connect()->query($sql);

		echo "<table style='margin-left:auto;margin-right:auto;width:100%;table-layout:fixed;border: 2px solid black';>";

		while($row = $stmt->fetch()) {
			echo '<tr style="margin-left:auto;margin-right:auto;width:100%;border: 2px solid black";>';
			echo '<td style="margin-left:auto;margin-right:auto;width:100%;border: 2px solid black";>' . $row['p_name'] . '</th>';
			echo '<td style="margin-left:auto;margin-right:auto;width:100%;border: 2px solid black";>' . $row['brand'] . '</th>';
			echo '<td style="margin-left:auto;margin-right:auto;width:100%;border: 2px solid black";>' . $row['price'] . '</th>';
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
}


?>

