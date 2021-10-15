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

    public function register($username, $password) 
    {
        $sql =<<<EOF
        SELECT *
        FROM ACCOUNT
        WHERE USERNAME = (?) AND HASHED_PASSWORD = (?)
        ;
        EOF;

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($username, $password));

        $res = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] = $row;
        }

        return $res;
    }  
}

?>