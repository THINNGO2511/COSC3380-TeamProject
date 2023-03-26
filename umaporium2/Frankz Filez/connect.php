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
			echo '<button type="button">' . 'Add to Cart' . '</button>';
			echo '</form>';
			echo '</td>';
			echo '</tr>';
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
			echo '<button type="button">' . 'Add to Cart' . '</button>';
			echo '</form>';
			echo '</td>';
			echo '</tr>';
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


}


?>

