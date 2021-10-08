<?php
   $sql =<<<EOF
      DROP TABLE IF EXISTS DORAYAKI;
      DROP TABLE IF EXISTS ACCOUNT;
      DROP TABLE IF EXISTS PURCHASE;
      DROP TABLE IF EXISTS CHANGE_STOCK;
   EOF;

   $res = $db->exec($sql);
   if(!$res){
      echo $db->lastErrorMsg();
   } else {
      echo "Successfully reset the database<br/>";
   }
   
?>