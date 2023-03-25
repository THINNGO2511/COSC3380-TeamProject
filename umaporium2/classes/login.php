<?php

class Login extends Dbh {


    protected function getUser($email, $password) {
        // Find password belonging to user with the entered email
        $stmt = $this->connect()->prepare('SELECT password FROM customer WHERE email = ?;');

        if(!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        
        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../index.php?error=usernotfound");
            exit();
        }

        // hash the entered password and verify that the password is a match
        $hashedPass = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPass = password_verify($password, $hashedPass[0]["password"]);

        if($checkPass == false) {
            $stmt = null;
            header("location: ../index.php?error=incorrectpassword");
            exit();
        }
        elseif($checkPass == true) {
            // retrieve user data
            $stmt = $this->connect()->prepare('SELECT * FROM customer WHERE email = ? AND password = ?;');
            
            if(!$stmt->execute(array($email, $hashedPass[0]["password"]))) {
                $stmt = null;
                header("location: ../index.php?error=stmtfailed");
                exit();
            }

            // do i...need this?
            if($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../index.php?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["userid"] = $user[0]["customerid"];
            
            $stmt = null;
        }
        
        
    }

}