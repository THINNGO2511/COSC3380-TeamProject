<?php

class SignupContr extends Signup{

    private $fname;
    private $lname;
    private $email;
    private $password;

    public function __construct($fname, $lname, $email, $password)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->password = $password;


    }

    public function signupUser() {
        // Check for errors then create user
        if($this->emptyInput() == false) {
            // echo "Empty Input!";
            header("location: ../index.php?error=emptyInput");
        }
        if($this->invalidEmail() == false) {
            // echo "Invalid Email!";
            header("location: ../index.php?error=email");
        }
        if($this->checkUserExists() == false) {
            // echo "User already exists with this email!";
            header("location: ../index.php?error=usertaken");
        }

        $this->setUser($this->fname, $this->lname, $this->email, $this->password);
    }

    private function emptyInput()
    {
        //Error handler: required field(s) empty
        $result;
        if(empty($this->fname) || empty($this->lname) || empty($this->email) || empty($this->password)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    /*private function invalidInput()
    {
        $result;
        if(!preg_match("/^[a-zA-Z0-9]*$/", $this->fname)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }*/

    private function invalidEmail()
    {
        // Error handler: Incorrect email format
        $result;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    private function checkUserExists()
    {
        // Error handler: User already exists
        $result;
        if(!$this->checkUser($this->email)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }
}