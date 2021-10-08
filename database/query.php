<?php
    include 'connect.php';

    /* SEARCH DORAYAKI ON NAME */
    function QUERY_DORAYAKI_SEARCH($db, $name) {
        $sql =<<<EOF
        SELECT *
        FROM DORAYAKI
        WHERE NAME LIKE '%$name%'
        ;
        EOF;

        $allRow=array();
        $res = $db->query($sql);
        if(!$res){
            echo $db->lastErrorMsg();
        } else {
            while($row = $res->fetchArray(SQLITE3_ASSOC)) {
                print_r($row);
                array_push($allRow, $row);
                echo "<br/>";
            }
        }
        return $allRow;
    }

    /* GET DORAYAKI DETAIL */
    function QUERY_DORAYAKI_DETAIL($db, $id) {
        $sql =<<<EOF
        SELECT *
        FROM DORAYAKI
        WHERE ID = $id
        ;
        EOF;

        $allRow=array();
        $res = $db->query($sql);
        if(!$res){
            echo $db->lastErrorMsg();
        } else {
            while($row = $res->fetchArray(SQLITE3_ASSOC)) {
                print_r($row);
                array_push($allRow, $row);
                echo "<br/>";
            }
        }
        return $allRow;
    }

    /* GET DORAYAKI LIST BASED ON POPULARITY */
    function QUERY_DORAYAKI_LIST_POPULARITY($db) {
        $sql =<<<EOF
        SELECT SUM(QUANTITY) AS SOLD, DORAYAKI_ID, NAME, DESCRIPTION, PRICE, STOCK
        FROM PURCHASE
        NATURAL INNER JOIN DORAYAKI D
        GROUP BY DORAYAKI_ID
        ORDER BY SUM(QUANTITY) DESC
        ;
        EOF;

        $allRow=array();
        $res = $db->query($sql);
        if(!$res){
            echo $db->lastErrorMsg();
        } else {
            while($row = $res->fetchArray(SQLITE3_ASSOC)) {
                print_r($row);
                array_push($allRow, $row);
                echo "<br/>";
            }
        }
        return $allRow;
    }

    /* BUY DORAYAKI DETAIL */
    function QUERY_DORAYAKI_BUY($db, $dorayaki_id, $buyer_id, $qty) {
        $sql =<<<EOF
        UPDATE DORAYAKI
        SET STOCK = STOCK - $qty
        WHERE ID = $dorayaki_id;

        INSERT INTO PURCHASE
        (DORAYAKI_ID,BUYER_ID,QUANTITY,CREATED_AT)
        VALUES ($dorayaki_id,$buyer_id,$qty,DATE());
        EOF;

        $allRow=array();
        $res = $db->exec($sql);
        if(!$res){
            echo $db->lastErrorMsg();
        } else {
            echo "Successfully bought ". $qty . " Item(s)<br/>";
        }
    }

    echo "<br/>" . "SEARCH DORAYAKI ON NAME" . "<br/>";
    QUERY_DORAYAKI_SEARCH($db, "a");

    echo "<br/>" . "SEARCH DORAYAKI ON NAME" . "<br/>";
    QUERY_DORAYAKI_SEARCH($db, "Boom");

    echo "<br/>" . "GET DORAYAKI DETAIL" . "<br/>";
    QUERY_DORAYAKI_DETAIL($db, 1);
    
    echo "<br/>" . "GET DORAYAKI LIST BASED ON POPULARITY " . "<br/>";
    QUERY_DORAYAKI_LIST_POPULARITY($db);

    echo "<br/>" . "BUY DORAYAKI" . "<br/>";
    QUERY_DORAYAKI_BUY($db,7,3,1);

    $db->close();
?>