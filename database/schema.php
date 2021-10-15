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

   try {
      $res = $db->exec($sql);
      echo "Successfully created Dorayaki table<br/>";
   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
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

   try {
      $res = $db->exec($sql);
      echo "Successfully created Account table<br/>";
   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
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
         CREATED_AT DATETIME NOT NULL,
         FOREIGN KEY (DORAYAKI_ID) REFERENCES Dorayaki(ID),
         FOREIGN KEY (BUYER_ID) REFERENCES Account(ID)
      );
   EOF;

   try {
      $res = $db->exec($sql);
      echo "Successfully created Purchase table<br/>";
   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
   }
   /* END PURCHASE TABLE*/

   /* START CHANGE_STOCK TABLE*/
   $sql =<<<EOF
      CREATE TABLE IF NOT EXISTS CHANGE_STOCK
      (
         ID INTEGER PRIMARY KEY AUTOINCREMENT,
         DORAYAKI_ID INTEGER,
         CHANGER_ID INTEGER,
         CREATED_AT DATETIME NOT NULL,
         FOREIGN KEY (DORAYAKI_ID) REFERENCES Dorayaki(ID),
         FOREIGN KEY (CHANGER_ID) REFERENCES Account(ID)
      );
   EOF;

   try {
      $res = $db->exec($sql);
      echo "Successfully created ChangeStock table<br/>";
   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
   }
   /* END CHANGE_STOCK TABLE*/

?>