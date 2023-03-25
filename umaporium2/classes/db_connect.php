<?php

class Dbh {

    public function connect() {
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
}
?>
		

		