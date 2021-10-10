<?php
    try {
        $db = new PDO("sqlite:database.db");
        echo "Successfully connected to database<br/>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>