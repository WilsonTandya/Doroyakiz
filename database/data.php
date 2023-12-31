<?php
   /* START DORAYAKI TABLE*/
   $sql =<<<EOF
      INSERT INTO DORAYAKI VALUES
      (1, 'Dorayaki Rasa Nanas', 'Dorayaki ini rasanya seperti nanas', 5000, 200, '1.jpg'),
      (2, 'Dorayaki Rasa Ikan', 'Dorayaki ini rasanya seperti makhluk laut', 10000, 250, '2.png'),
      (3, 'Dorayaki Crispy', 'Dorayaki ini gurih dan renyah', 3000, 100, '3.jpg'),
      (4, 'Dorayaki Rasa Nasi Goreng', 'Dorayaki ini rasanya seperti nasi goreng bawang putih', 15000, 180, '4.jpg'),
      (5, 'Dorayaki Supreme', 'Dorayaki ini mahal dan terbatas', 50000, 50, '5.jpg'),
      (6, 'Dorayaki Kayu', 'Dorayaki ini estetik dengan bau kayu-kayuan', 1000, 150, '6.png'),
      (7, 'Dorayaki Biasa', 'Dorayaki ini biasa aja bro', 1000, 500, '7.jpeg'),
      (8, 'Dorayaki Cokelat Mayonais', 'Dorayaki ini sangat lezat, sehat, dan bergizi', 5000, 250, '8.png'),
      (9, 'Dorayaki Wortel Jelly', 'Dorayaki ini manis dan sehat', 3000, 350, '9.jpg'),
      (10, 'Dorayaki Palsu', 'Dorayaki KW gan', 500, 550, '10.jpg'),
      (11, 'Dorayaki Doraemon', 'Dorayaki ini dicuri dari Doraemon', 50000, 950, '11.png'),
      (12, 'Dorayaki Teppanyaki', 'Dorayaki ini dibuat oleh koki Jepang yang hebat', 10550, 150, '12.jpg'),
      (13, 'Dorayaki Dorayaki', 'Dorayaki ini rekursif', 19500, 450, '13.jpg'),
      (14, 'Dorayaki Isi Kacang Merah', 'Dorayaki ini bukan berisi kacang hijau', 5000, 350, '14.jpg'),
      (15, 'Dorayaki Isi Kacang Hijau', 'Dorayaki ini bukan berisi kacang merah', 8150, 500, '15.jpg'),
      (16, 'Dorayaki Asus', 'Dorayaki ini canggih', 19000, 500,'16.jpg' )
      ;
   EOF;

   try {
      $res = $db->exec($sql);
      echo "Successfully inserted dummy data to Dorayaki table<br/>";   
   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
   }
   /* END DORAYAKI TABLE*/

   /* START DORAYAKI ALL TABLE*/
   $sql =<<<EOF
      INSERT INTO DORAYAKI_ALL VALUES
      (1, 'Dorayaki Rasa Nanas', 'Dorayaki ini rasanya seperti nanas', 5000, 200, '1.jpg'),
      (2, 'Dorayaki Rasa Ikan', 'Dorayaki ini rasanya seperti makhluk laut', 10000, 250, '2.png'),
      (3, 'Dorayaki Crispy', 'Dorayaki ini gurih dan renyah', 3000, 100, '3.jpg'),
      (4, 'Dorayaki Rasa Nasi Goreng', 'Dorayaki ini rasanya seperti nasi goreng bawang putih', 15000, 180, '4.jpg'),
      (5, 'Dorayaki Supreme', 'Dorayaki ini mahal dan terbatas', 50000, 50, '5.jpg'),
      (6, 'Dorayaki Kayu', 'Dorayaki ini estetik dengan bau kayu-kayuan', 1000, 150, '6.png'),
      (7, 'Dorayaki Biasa', 'Dorayaki ini biasa aja bro', 1000, 500, '7.jpeg'),
      (8, 'Dorayaki Cokelat Mayonais', 'Dorayaki ini sangat lezat, sehat, dan bergizi', 5000, 250, '8.png'),
      (9, 'Dorayaki Wortel Jelly', 'Dorayaki ini manis dan sehat', 3000, 350, '9.jpg'),
      (10, 'Dorayaki Palsu', 'Dorayaki KW gan', 500, 550, '10.jpg'),
      (11, 'Dorayaki Doraemon', 'Dorayaki ini dicuri dari Doraemon', 50000, 950, '11.png'),
      (12, 'Dorayaki Teppanyaki', 'Dorayaki ini dibuat oleh koki Jepang yang hebat', 10550, 150, '12.jpg'),
      (13, 'Dorayaki Dorayaki', 'Dorayaki ini rekursif', 19500, 450, '13.jpg'),
      (14, 'Dorayaki Isi Kacang Merah', 'Dorayaki ini bukan berisi kacang hijau', 5000, 350, '14.jpg'),
      (15, 'Dorayaki Isi Kacang Hijau', 'Dorayaki ini bukan berisi kacang merah', 8150, 500, '15.jpg'),
      (16, 'Dorayaki Asus', 'Dorayaki ini canggih', 19000, 500,'16.jpg' )
      ;
   EOF;

   try {
      $res = $db->exec($sql);
      echo "Successfully inserted dummy data to DorayakiAll table<br/>";   
   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
   }
   /* END DORAYAKI ALL TABLE*/

   /* START ACCOUNT TABLE*/
   $sql =<<<EOF
      INSERT INTO ACCOUNT VALUES
      (1, 'John Doe', 'john_d', 'john.doe21@gmail.com', '9OlX', 1),
      (2, 'Jane Doe', 'jane_d', 'jane.doe43@gmail.com', '9OlX', 1),
      (3, 'Nazh Meh', 'nazhm', 'naaaaz@gmail.com', '9u9R', 0),
      (4, 'Lee Bob', 'leebob12', 'leebob123@yahoo.com', '9u9R', 0),
      (5, 'Udin Syarifudin', 'udins', 'udins@gmail.com', '9u9R', 0)
      ;
   EOF;

   try {
      $res = $db->exec($sql);
      echo "Successfully inserted dummy data to Account table<br/>";   
   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
   }
   /* END ACCOUNT TABLE*/


   /* START PURCHASE TABLE*/
   $sql =<<<EOF
      INSERT INTO PURCHASE 
      (DORAYAKI_ID,BUYER_ID,QUANTITY,CREATED_AT)
      VALUES
      (1,3,10,'2021-08-12 10:00:00'),
      (1,4,15,'2021-08-23 00:00:00'),
      (3,4,8,'2021-08-29 11:00:00'),
      (9,5,9,'2021-09-07 14:50:59'),
      (4,5,3,'2021-09-07 01:00:00'),
      (7,3,3,'2021-09-11 03:00:00'),
      (7,4,11,'2021-09-12 10:00:00'),
      (10,5,23,'2021-09-14 11:30:30')
      ;
   EOF;

   try {
      $res = $db->exec($sql);
      echo "Successfully inserted dummy data to Purchase table<br/>";   
   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
   }
   /* END PURCHASE TABLE*/

   /* START CHANGE_STOCK TABLE*/
   $sql =<<<EOF
      INSERT INTO CHANGE_STOCK 
      (DORAYAKI_ID,CHANGER_ID,QUANTITY,CREATED_AT)
      VALUES
      (8,1,100,'2021-09-12 19:21:40'),
      (10,1,132,'2021-09-12 17:00:00'),
      (2,2,100,'2021-09-12 09:00:00'),
      (3,1,350,'2021-09-13 01:30:00'),
      (1,1,10,'2021-09-13 00:00:30')
      ;
   EOF;

   try {
      $res = $db->exec($sql);
      echo "Successfully inserted dummy data to ChangeStock table<br/>";   
   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
   }
   /* END CHANGE_STOCK TABLE*/

?>