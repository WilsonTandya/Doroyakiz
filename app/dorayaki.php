<?php

include 'controller.php';

class Dorayaki extends Controller {

    public function __construct()
    {        
        parent::__construct();
    }

    public function search($name, $offset, $n_records_per_page) 
    {
        // $name nanti ganti jadi $_GET
        $sql =<<<EOF
        SELECT *
        FROM DORAYAKI
        WHERE NAME LIKE (?)
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
        // $id nanti ganti jadi $_GET
        $sql =<<<EOF
        SELECT *
        FROM DORAYAKI
        WHERE ID = (?)
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
        SELECT SUM(QUANTITY) AS SOLD, DORAYAKI_ID, NAME, DESCRIPTION, PRICE, STOCK
        FROM PURCHASE
        NATURAL INNER JOIN DORAYAKI D
        GROUP BY DORAYAKI_ID
        ORDER BY SUM(QUANTITY) DESC
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
        // ganti jadi $_GET
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
        // ganti jadi $_GET
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
        (DORAYAKI_ID,CHANGER_ID,CREATED_AT)
        VALUES (:dorayaki_id,:changer_id,DATETIME());
        EOF;

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":dorayaki_id", $dorayaki_id);
        $stmt->bindParam(":changer_id", $changer_id);
        $res2 = $stmt->execute();

        return $res1 && $res2;
    }
}

/* TEST CONSTANT */
$page_no = 1;
$n_records_per_page = 5;
$offset = ($page_no-1) * $n_records_per_page;

$test = new Dorayaki();
$res = $test->search("Rasa",$offset,$n_records_per_page);
print_r($res);
echo "<br/>";
$res = $test->detail(3);
print_r($res); 
echo "<br/>";
$res = $test->list_popular();
echo "<br/>" . $res[0]->NAME . "<br/>";
$res = $test->buy(7,3,1);
echo "<br/>" .  $res . "<br/>";
$res = $test->change_stock(4,1,1000);
echo $res;

?>