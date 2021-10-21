<?php
   $sql =<<<EOF
      DROP TABLE IF EXISTS DORAYAKI;
      DROP TABLE IF EXISTS DORAYAKI_ALL;
      DROP TABLE IF EXISTS ACCOUNT;
      DROP TABLE IF EXISTS PURCHASE;
      DROP TABLE IF EXISTS CHANGE_STOCK;
   EOF;

   try {
      $res = $db->exec($sql);
      echo "Successfully reset the database<br/>";
   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
   }
?>