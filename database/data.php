<?php
   /* START DORAYAKI TABLE*/
   $sql =<<<EOF
      INSERT INTO DORAYAKI VALUES
      (1, 'Dorayaki Rasa Nanas', 'Dorayaki ini rasanya seperti nanas', 5000, 200),
      (2, 'Dorayaki Rasa Ikan', 'Dorayaki ini rasanya seperti makhluk laut', 10000, 250),
      (3, 'Dorayaki Crispy', 'Dorayaki ini gurih dan renyah', 3000, 100),
      (4, 'Dorayaki Rasa Nasi Goreng', 'Dorayaki ini rasanya seperti nasi goreng dengan bawang putih', 15000, 180),
      (5, 'Dorayaki Supreme', 'Dorayaki ini mahal dan terbatas', 50000, 50),
      (6, 'Dorayaki Kayu', 'Dorayaki ini estetik dengan bau kayu-kayuan', 1000, 150),
      (7, 'Dorayaki Biasa', 'Dorayaki ini biasa aja bro', 1000, 500),
      (8, 'Dorayaki Cokelat Mayonais', 'Dorayaki ini sangat lezat, sehat, dan bergizi', 5000, 250),
      (9, 'Dorayaki Wortel Jelly', 'Dorayaki ini manis dan sehat', 3000, 350),
      (10, 'Dorayaki Terasi', 'Dorayaki ini dibuat dari terasi pilihan berkualitas', 10000, 350)
      ;
   EOF;

   $res = $db->exec($sql);
   if(!$res){
      echo $db->lastErrorMsg();
   } else {
      echo "Successfully inserted dummy data to Dorayaki table<br/>";
   }
   /* END DORAYAKI TABLE*/


   /* START ACCOUNT TABLE*/
   $sql =<<<EOF
      INSERT INTO ACCOUNT VALUES
      (1, 'John Doe', 'john_d', 'john.doe21@gmail.com', '123', 1),
      (2, 'Jane Doe', 'jane_d', 'jane.doe43@gmail.com', '123', 1),
      (3, 'Nazh Meh', 'nazhm', 'naaaaz@gmail.com', '345', 0),
      (4, 'Lee Bob', 'leebob12', 'leebob123@yahoo.com', '345', 0),
      (5, 'Udin Syarifudin', 'udins', 'udins@gmail.com', '345', 0)
      ;
   EOF;

   $res = $db->exec($sql);
   if(!$res){
      echo $db->lastErrorMsg();
   } else {
      echo "Successfully inserted dummy data to Account table<br/>";
   }
   /* END ACCOUNT TABLE*/


   /* START PURCHASE TABLE*/
   $sql =<<<EOF
      INSERT INTO PURCHASE 
      (DORAYAKI_ID,BUYER_ID,QUANTITY,CREATED_AT)
      VALUES
      (1,3,10,'2021-08-12'),
      (1,4,15,'2021-08-23'),
      (3,4,8,'2021-08-29'),
      (9,5,9,'2021-09-07'),
      (4,5,3,'2021-09-07'),
      (7,3,3,'2021-09-11'),
      (7,4,11,'2021-09-12'),
      (10,5,23,'2021-09-14')
      ;
   EOF;

   $res = $db->exec($sql);
   if(!$res){
      echo $db->lastErrorMsg();
   } else {
      echo "Successfully inserted dummy data to Purchase table<br/>";
   }
   /* END PURCHASE TABLE*/

   /* START CHANGE_STOCK TABLE*/
   $sql =<<<EOF
      INSERT INTO CHANGE_STOCK 
      (DORAYAKI_ID,CHANGER_ID,CREATED_AT)
      VALUES
      (8,1,'2021-09-12'),
      (10,1,'2021-09-12'),
      (2,2,'2021-09-12'),
      (3,1,'2021-09-13'),
      (1,1,'2021-09-13')
      ;
   EOF;

   $res = $db->exec($sql);
   if(!$res){
      echo $db->lastErrorMsg();
   } else {
      echo "Successfully inserted dummy data to Purchase table<br/>";
   }
   /* END CHANGE_STOCK TABLE*/

?>