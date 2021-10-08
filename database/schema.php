<?php
   /* START DORAYAKI TABLE*/
   $sql =<<<EOF
      CREATE TABLE IF NOT EXISTS DORAYAKI
      (
         ID INTEGER PRIMARY KEY AUTOINCREMENT,
         NAME CHAR(255) NOT NULL,
         DESCRIPTION TEXT,
         PRICE REAL NOT NULL CHECK(PRICE>0),
         STOCK INTEGER NOT NULL CHECK(STOCK>0)
      );
   EOF;

   $res = $db->exec($sql);
   if(!$res){
      echo $db->lastErrorMsg();
   } else {
      echo "Successfully created Dorayaki table<br/>";
   }
   /* END DORAYAKI TABLE*/


   /* START ACCOUNT TABLE*/
   $sql =<<<EOF
      CREATE TABLE IF NOT EXISTS ACCOUNT
      (
         ID INTEGER PRIMARY KEY AUTOINCREMENT,
         NAME CHAR(255) NOT NULL,
         USERNAME CHAR(255) NOT NULL,
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
   /* END ACCOUNT TABLE*/


   /* START PURCHASE TABLE*/
   $sql =<<<EOF
      CREATE TABLE IF NOT EXISTS PURCHASE
      (
         ID INTEGER PRIMARY KEY AUTOINCREMENT,
         DORAYAKI_ID INTEGER,
         BUYER_ID INTEGER,
         QUANTITY INTEGER NOT NULL CHECK(QUANTITY>0),
         CREATED_AT DATE NOT NULL,
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
   /* END PURCHASE TABLE*/

   /* START CHANGE_STOCK TABLE*/
   $sql =<<<EOF
      CREATE TABLE IF NOT EXISTS CHANGE_STOCK
      (
         ID INTEGER PRIMARY KEY AUTOINCREMENT,
         DORAYAKI_ID INTEGER,
         CHANGER_ID INTEGER,
         CREATED_AT DATE NOT NULL,
         FOREIGN KEY (DORAYAKI_ID) REFERENCES Dorayaki(ID),
         FOREIGN KEY (CHANGER_ID) REFERENCES Account(ID)
      );
   EOF;

   $res = $db->exec($sql);
   if(!$res){
      echo $db->lastErrorMsg();
   } else {
      echo "Successfully created ChangeStock table<br/>";
   }
   /* END CHANGE_STOCK TABLE*/

?>