<?php

class Controller {
    protected object $db;

    public function __construct() 
    {
        try {
            $this->db = new PDO("sqlite:../database/database.db");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

?>