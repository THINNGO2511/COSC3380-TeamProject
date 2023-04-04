<?php

class Dbh {

    public function connect() {
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
}
?>
		

		
