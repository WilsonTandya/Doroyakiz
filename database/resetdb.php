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

   $sql =<<<EOF
      DROP TABLE IF EXISTS DORAYAKI;
      DROP TABLE IF EXISTS ACCOUNT;
      DROP TABLE IF EXISTS PURCHASE;
   EOF;

   $res = $db->exec($sql);
   if(!$res){
      echo $db->lastErrorMsg();
   } else {
      echo "Successfully reset the database<br/>";
   }
   
   $db->close();
?>