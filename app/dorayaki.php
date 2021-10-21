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
        SELECT IFNULL(SUM(QUANTITY), 0) AS SOLD, DORAYAKI.ID, NAME, DESCRIPTION, PRICE, STOCK, IMG_FILE
        FROM DORAYAKI
        LEFT JOIN PURCHASE P ON DORAYAKI.ID = P.DORAYAKI_ID
        WHERE LOWER(NAME) LIKE (?)
        GROUP BY DORAYAKI.ID
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

    public function search_total_records($name) 
    {
        $sql =<<<EOF
        SELECT COUNT(*) AS TOTAL
        FROM DORAYAKI
        WHERE LOWER(NAME) LIKE (?)
        ;
        EOF;

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array("%" . $name . "%"));
        $res = $stmt->fetch(PDO::FETCH_OBJ);

        return $res->TOTAL;
    }

    public function detail($id) 
    {
        $sql =<<<EOF
        SELECT IFNULL(SUM(QUANTITY), 0) AS SOLD, DORAYAKI.ID, NAME, DESCRIPTION, PRICE, STOCK, IMG_FILE
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

    public function detail_all($id) 
    {
        $sql =<<<EOF
        SELECT IFNULL(SUM(QUANTITY), 0) AS SOLD, DORAYAKI_ALL.ID, NAME, DESCRIPTION, PRICE, STOCK, IMG_FILE
        FROM DORAYAKI_ALL
        LEFT JOIN PURCHASE P ON DORAYAKI_ALL.ID = P.DORAYAKI_ID
        WHERE DORAYAKI_ALL.ID = (?)
        GROUP BY DORAYAKI_ALL.ID
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
        SELECT IFNULL(SUM(QUANTITY), 0) AS SOLD, DORAYAKI.ID, NAME, DESCRIPTION, PRICE, STOCK, IMG_FILE
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
        $res1 = $stmt->execute();

        $sql =<<<EOF
        UPDATE DORAYAKI_ALL
        SET STOCK = STOCK - :qty
        WHERE ID = :dorayaki_id;
        EOF;

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":dorayaki_id", $dorayaki_id);
        $stmt->bindParam(":qty", $qty);
        $res2 = $stmt->execute();

        return $res1 && $res2;
    }

    public function make_purchase($dorayaki_id, $buyer_id, $qty) 
    {
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

    public function purchase_history($id, $is_admin) {
        if ($is_admin == 1) {
            $sql =<<<EOF
            SELECT D.NAME as VARIANT, A.NAME as BUYER, PURCHASE.CREATED_AT as BUY_DATE, 
            PURCHASE.QUANTITY as QUANTITY, D.ID as DORAYAKI_ID, D.PRICE * PURCHASE.QUANTITY AS TOTAL
            FROM PURCHASE
            INNER JOIN DORAYAKI_ALL D ON PURCHASE.DORAYAKI_ID = D.ID
            INNER JOIN ACCOUNT A ON PURCHASE.BUYER_ID = A.ID
            WHERE A.ISADMIN = 0 OR A.ID = (?)
            ORDER BY BUY_DATE ASC
            ;
            EOF;

            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($id));
        }
        else {
            $sql =<<<EOF
            SELECT D.NAME as VARIANT, A.NAME as BUYER, PURCHASE.CREATED_AT as BUY_DATE, 
            PURCHASE.QUANTITY as QUANTITY, D.ID as DORAYAKI_ID, D.PRICE * PURCHASE.QUANTITY AS TOTAL
            FROM PURCHASE
            INNER JOIN DORAYAKI_ALL D ON PURCHASE.DORAYAKI_ID = D.ID
            INNER JOIN ACCOUNT A ON PURCHASE.BUYER_ID = A.ID
            WHERE A.ID = (?)
            ORDER BY BUY_DATE ASC
            ;
            EOF;

            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($id));
        }

        $res = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] = $row;
        }
		return $res;
    }

    public function change_history($id, $is_admin) {
        if ($is_admin == 1) {
            $sql =<<<EOF
            SELECT D.NAME as VARIANT, A.NAME as CHANGER, CHANGE_STOCK.CREATED_AT as CHANGE_DATE, 
            CHANGE_STOCK.QUANTITY as QUANTITY, D.ID as DORAYAKI_ID
            FROM CHANGE_STOCK
            INNER JOIN DORAYAKI_ALL D ON CHANGE_STOCK.DORAYAKI_ID = D.ID
            INNER JOIN ACCOUNT A ON CHANGE_STOCK.CHANGER_ID = A.ID
            WHERE A.ID = (?)
            ORDER BY CHANGE_DATE ASC
            ;
            EOF;

            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($id));

            $res = array();
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                $res[] = $row;
            }
            return $res;
        }
        else {
            return NULL;
        }
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

    public function add_dorayaki($name, $price, $qty, $desc, $img) {
        $sql =<<<EOF
        INSERT INTO DORAYAKI (NAME, DESCRIPTION, PRICE, STOCK, IMG_FILE)
        VALUES ((?), (?), (?), (?), (?))
        EOF;

        $addVariantSuccess1 = false;
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($name, $desc, $price, $qty, $img));
            $addVariantSuccess1 = true; 
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $sql =<<<EOF
        INSERT INTO DORAYAKI_ALL (NAME, DESCRIPTION, PRICE, STOCK, IMG_FILE)
        VALUES ((?), (?), (?), (?), (?))
        EOF;

        $addVariantSuccess2 = false;
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($name, $desc, $price, $qty, $img));
            $addVariantSuccess2 = true; 
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $addVariantSuccess1 && $addVariantSuccess2;
    }
}

?>