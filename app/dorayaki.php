<?php

include 'controller.php';

class Dorayaki extends Controller {

    public function __construct()
    {        
        parent::__construct();
    }

    public function search($name, $offset, $n_records_per_page) 
    {
        $sql =<<<EOF
        SELECT IFNULL(SUM(QUANTITY), 0) AS SOLD, DORAYAKI.ID, NAME, DESCRIPTION, PRICE, STOCK
        FROM DORAYAKI
        LEFT JOIN PURCHASE P ON DORAYAKI.ID = P.DORAYAKI_ID
        WHERE LOWER(NAME) LIKE (?)
        GROUP BY DORAYAKI_ID
        ORDER BY NAME ASC
        LIMIT (?), (?)
        ;
        EOF;

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array("%" . $name . "%", $offset, $n_records_per_page));

        $res = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] = $row;
        }

        return $res;
    }

    public function detail($id) 
    {
        $sql =<<<EOF
        SELECT IFNULL(SUM(QUANTITY), 0) AS SOLD, DORAYAKI.ID, NAME, DESCRIPTION, PRICE, STOCK
        FROM DORAYAKI
        LEFT JOIN PURCHASE P ON DORAYAKI.ID = P.DORAYAKI_ID
        WHERE DORAYAKI.ID = (?)
        GROUP BY DORAYAKI.ID
        ;
        EOF;

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($id));
        $res = $stmt->fetch(PDO::FETCH_OBJ);

		return $res;
    }

    public function list_popular() 
    {
        $sql =<<<EOF
        SELECT IFNULL(SUM(QUANTITY), 0) AS SOLD, DORAYAKI.ID, NAME, DESCRIPTION, PRICE, STOCK
        FROM DORAYAKI
        LEFT JOIN PURCHASE P ON DORAYAKI.ID = P.DORAYAKI_ID
        GROUP BY DORAYAKI.ID
        ORDER BY SOLD DESC
        LIMIT 10
        ;
        EOF;

        $q = $this->db->query($sql);
        $res = array();
        while ($row = $q->fetch(PDO::FETCH_OBJ)) {
            $res[] = $row;
        }
		return $res;
    }

    public function substract_stock($dorayaki_id, $qty) 
    {
        $sql =<<<EOF
        UPDATE DORAYAKI
        SET STOCK = STOCK - :qty
        WHERE ID = :dorayaki_id;
        EOF;

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":dorayaki_id", $dorayaki_id);
        $stmt->bindParam(":qty", $qty);
        $res = $stmt->execute();

        return $res;
    }

    public function make_purchase($dorayaki_id, $buyer_id, $qty) 
    {
        // REMINDER- Move to new controller
        // ganti jadi $_GET
        $sql =<<<EOF
        INSERT INTO PURCHASE
        (DORAYAKI_ID,BUYER_ID,QUANTITY,CREATED_AT)
        VALUES (:dorayaki_id,:buyer_id,:qty,DATETIME());
        EOF;

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":dorayaki_id", $dorayaki_id);
        $stmt->bindParam(":buyer_id", $buyer_id);
        $stmt->bindParam(":qty", $qty);
        $res = $stmt->execute();

        return $res;
    }

    public function buy($dorayaki_id, $buyer_id, $qty) 
    {
        $res1 = $this->substract_stock($dorayaki_id, $qty);
        $res2 = $this->make_purchase($dorayaki_id, $buyer_id, $qty);
        return $res1 && $res2;
    }

    public function update_stock($dorayaki_id, $qty) 
    {
        $sql =<<<EOF
        UPDATE DORAYAKI
        SET STOCK = :qty
        WHERE ID = :dorayaki_id;
        EOF;

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":dorayaki_id", $dorayaki_id);
        $stmt->bindParam(":qty", $qty);
        $res = $stmt->execute();

        return $res;
    }

    public function change_stock($dorayaki_id, $changer_id, $qty) 
    {
        $res1 = $this->update_stock($dorayaki_id, $qty);
        
        $sql =<<<EOF
        INSERT INTO CHANGE_STOCK
        (DORAYAKI_ID,CHANGER_ID,QUANTITY,CREATED_AT)
        VALUES (:dorayaki_id,:changer_id,:qty,DATETIME());
        EOF;

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":dorayaki_id", $dorayaki_id);
        $stmt->bindParam(":changer_id", $changer_id);
        $stmt->bindParam(":qty", $qty);
        $res2 = $stmt->execute();

        return $res1 && $res2;
    }

    public function purchase_history() {
        $sql =<<<EOF
        SELECT D.NAME as VARIANT, A.NAME as BUYER, PURCHASE.CREATED_AT as BUY_DATE, PURCHASE.QUANTITY as QUANTITY, D.ID as DORAYAKI_ID
        FROM PURCHASE
        INNER JOIN DORAYAKI D ON PURCHASE.DORAYAKI_ID = D.ID
        INNER JOIN ACCOUNT A ON PURCHASE.BUYER_ID = A.ID
        ;
        EOF;

        $q = $this->db->query($sql);
        $res = array();
        while ($row = $q->fetch(PDO::FETCH_OBJ)) {
            $res[] = $row;
        }
		return $res;
    }

    public function change_history() {
        $sql =<<<EOF
        SELECT D.NAME as VARIANT, A.NAME as CHANGER, CHANGE_STOCK.CREATED_AT as CHANGE_DATE, D.ID as DORAYAKI_ID
        FROM CHANGE_STOCK
        INNER JOIN DORAYAKI D ON CHANGE_STOCK.DORAYAKI_ID = D.ID
        INNER JOIN ACCOUNT A ON CHANGE_STOCK.CHANGER_ID = A.ID
        ;
        EOF;

        $q = $this->db->query($sql);
        $res = array();
        while ($row = $q->fetch(PDO::FETCH_OBJ)) {
            $res[] = $row;
        }
		return $res;
    }

    public function delete_dorayaki($dorayaki_id) {
        $sql =<<<EOF
        DELETE FROM DORAYAKI
        WHERE ID = :dorayaki_id;
        ;
        EOF;

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":dorayaki_id", $dorayaki_id);
        $res = $stmt->execute();

        return $res;
    }

    public function add_dorayaki($name, $price, $qty, $desc) {
        $sql =<<<EOF
        INSERT INTO DORAYAKI (NAME, DESCRIPTION, PRICE, STOCK)
        VALUES ((?), (?), (?), (?))
        EOF;

        $addVariantSuccess = false;
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($name, $desc, $price, $qty));
            $addVariantSuccess = true; 
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $addVariantSuccess;
    }
}

/* TEST CONSTANT */
// $page_no = 1;
// $n_records_per_page = 5;
// $offset = ($page_no-1) * $n_records_per_page;

// $test = new Dorayaki();
// $res = $test->search("Rasa",$offset,$n_records_per_page);
// print_r($res);
// echo "<br/>";
// $res = $test->detail(3);
// print_r($res); 
// echo "<br/>";
// $res = $test->list_popular();
// echo "<br/>" . $res[0]->NAME . "<br/>";
// $res = $test->buy(7,3,1);
// echo "<br/>" .  $res . "<br/>";
// $res = $test->change_stock(4,1,1000);
// echo $res;

?>