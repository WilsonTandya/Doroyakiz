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
      CREATE TABLE IF NOT EXISTS DORAYAKI
      (
         ID INT PRIMARY KEY,
         NAME CHAR(255) NOT NULL,
         DESCRIPTION TEXT,
         PRICE REAL NOT NULL,
         STOCK INT NOT NULL
      );
   EOF;

   $res = $db->exec($sql);
   if(!$res){
      echo $db->lastErrorMsg();
   } else {
      echo "Successfully created Dorayaki table<br/>";
   }

   $sql =<<<EOF
      CREATE TABLE IF NOT EXISTS ACCOUNT
      (
         ID INT PRIMARY KEY,
         NAME CHAR(255) NOT NULL,
         EMAIL CHAR(255) NOT NULL,
         HASHED_PASSWORD CHAR(255) NOT NULL,
         ISADMIN BOOL DEFAULT 0
      );
   EOF;

   $res = $db->exec($sql);
   if(!$res){
      echo $db->lastErrorMsg();
   } else {
      echo "Successfully created Account table<br/>";
   }

   $sql =<<<EOF
      CREATE TABLE IF NOT EXISTS PURCHASE
      (
         DORAYAKI_ID INT,
         BUYER_ID INT,
         QUANTITY INT NOT NULL,
         CREATED_AT DATE NOT NULL,
         PRIMARY KEY (DORAYAKI_ID, BUYER_ID),
         FOREIGN KEY (DORAYAKI_ID) REFERENCES Dorayaki(ID),
         FOREIGN KEY (BUYER_ID) REFERENCES Account(ID)
      );
   EOF;

   $res = $db->exec($sql);
   if(!$res){
      echo $db->lastErrorMsg();
   } else {
      echo "Successfully created Purchase table<br/>";
   }

   $sql =<<<EOF
      CREATE TABLE IF NOT EXISTS CHANGE_STOCK
      (
         DORAYAKI_ID INT,
         CHANGER_ID INT,
         CREATED_AT DATE NOT NULL,
         PRIMARY KEY (DORAYAKI_ID, CHANGER_ID),
         FOREIGN KEY (DORAYAKI_ID) REFERENCES Dorayaki(ID),
         FOREIGN KEY (CHANGER_ID) REFERENCES Account(ID)
      );
   EOF;

   $res = $db->exec($sql);
   if(!$res){
      echo $db->lastErrorMsg();
   } else {
      echo "Successfully created Purchase table<br/>";
   }
   
   $db->close();
?>