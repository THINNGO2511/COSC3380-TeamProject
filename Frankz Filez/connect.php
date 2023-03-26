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

	public function search($name, $color, $category, $description, $brand, $size, $pid){
		$sql = 'SELECT * FROM product WHERE';
		$a = "";
		$b = "";
		$c = "";
		$d = "";
		$e = "";
		$f = "";
		$g = "";
	
		if (!empty($name)) {
			$a = ' p_name LIKE ? ';
		} 

		if (!empty($color)) {
			$b = 'AND color LIKE ? ';
		} 

		if (!empty($category)) {
			$a = 'AND category LIKE ? ';
		} 
	
		if (!empty($description)) {
			$a = 'AND description LIKE ? ';
		} 

		if (!empty($brand)) {
			$a = 'AND brand LIKE ? ';
		} 

		if (!empty($size)) {
			$a = 'AND c_sizes LIKE ? ';
		} 

		if (!empty($pid)) {
			$a = 'AND p_id LIKE ?';
		} 

	

		$sql2 = $sql . $a . $b . $c . $d . $e . $f . $g . ";";

		$stmt = $this->connect()->prepare($sql2);
		$stmt->execute([$name, $color, $category, $description, $brand, $size, $pid]);
		
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




}


?>

