<?php

class Signup extends Dbh {

    protected function checkUser($email) {
        // Query the database to verify that user does not exist before proceeding with signup
        $stmt = $this->connect()->prepare('SELECT email FROM customer WHERE email = ?;');

        if(!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $resultCheck;
        if($stmt->rowCount() > 0) {
            $resultCheck = false;
        }
        else {
            $resultCheck = true;
        }

        return $resultCheck;
    }

    protected function setUser($fname, $lname, $email, $password) {
        // Insert new user data into the database
        $stmt = $this->connect()->prepare('INSERT INTO customer (namefirst, namelast, email, password) VALUES (?, ?, ?, ?);');

        $hashedPass = password_hash($password, PASSWORD_DEFAULT);

        if(!$stmt->execute(array($fname, $lname, $email, $hashedPass))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }
}