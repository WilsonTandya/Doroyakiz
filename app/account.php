<?php

include 'controller.php';

class Account extends Controller {

    public function __construct()
    {        
        parent::__construct();
    }

    public function login($username, $password) 
    {
        $sql =<<<EOF
            SELECT USERNAME
            FROM ACCOUNT
            WHERE USERNAME = (?) AND HASHED_PASSWORD = (?)
            ;
        EOF;

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($username, $password));

        $res = $stmt->fetch(PDO::FETCH_OBJ);

        return $res;
    }

    public function register($email, $fullname, $username, $password) 
    {
        $sql =<<<EOF
            INSERT INTO ACCOUNT (NAME, USERNAME, EMAIL, HASHED_PASSWORD, ISADMIN)
            VALUES ((?), (?), (?), (?), 0)
            ;
        EOF;

        $registerSuccess = false;
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($fullname, $username, $email, $password));
            $registerSuccess = true; 
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $registerSuccess;
    }

    public function isUsernameAvailable($username) 
    {
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            return false;
        }

        $sql =<<<EOF
            SELECT USERNAME
            FROM ACCOUNT
            WHERE USERNAME = (?)
            ;
        EOF;

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($username));

        $res = $stmt->fetch(PDO::FETCH_OBJ);

        return $res == NULL;
    }
}

?>