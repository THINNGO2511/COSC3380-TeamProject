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
			echo '<td>' . $row['p_name'] . '</th>';
			echo '<td>' . $row['color'] . '</th>';
			echo '<td>' . $row['category'] . '</th>';
			echo '<td>' . $row['description'] . '</th>';
			echo '<td>' . $row['brand'] . '</th>';
			echo '<td>' . $row['c_sizes'] . '</th>';
			echo '<td>';
			echo '<form method="post">';
			echo '<button type="button">' . 'Add to Cart' . '</button>';
			echo '</form>';
			echo '</td>';
			echo '</tr>';
		}

	}

	public function search($keyword){
		$sql = "SELECT * FROM product WHERE p_name LIKE '%$keyword$' or color LIKE '%$keyword$' or category LIKE '%$keyword$' or brand LIKE '%$keyword$'";

		$stmt = $this->connect()->query($sql);
		
		echo '<table>';

		while($row = $stmt->fetch()) {
			echo '<tr>';
			echo '<td>' . $row['p_name'] . '</th>';
			echo '<td>' . $row['color'] . '</th>';
			echo '<td>' . $row['category'] . '</th>';
			echo '<td>' . $row['description'] . '</th>';
			echo '<td>' . $row['brand'] . '</th>';
			echo '<td>' . $row['c_sizes'] . '</th>';
			echo '<td>';
			echo '<form method="post">';
			echo '<button type="button">' . 'Add to Cart' . '</button>';
			echo '</form>';
			echo '</td>';
			echo '</tr>';
		}

		echo '</table>';
	}

	public function insertproduct($name, $color, $category, $subcategory, $description, $brand, $size) {
		$sql = 'INSERT INTO product(p_name, color, category, subcategory, description, brand, c_sizes) VALUES (?, ?, ?, ?, ?, ?, ?);';

		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$name, $color, $category, $subcategory, $description, $brand, $size]);

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

	public function itemfind($pid){
		$sql = 'SELECT * FROM product WHERE p_id=$pid';
		
		$stmt = $this->connect()->query($sql);
	}


}


?>

