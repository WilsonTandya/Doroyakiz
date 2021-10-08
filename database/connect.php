<?php
    class DB extends SQLite3 {
        function __construct() {
            $this->open('./database.db');
        }
    }
    
    $db = new DB();

    if (!$db) {
        echo $db->lastErrorMsg();
    } else {
        echo "Successfully connected to database<br/>";
    }
?>