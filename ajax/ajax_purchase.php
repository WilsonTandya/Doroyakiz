<?php
    require_once "../app/dorayaki.php";
    require_once "../pages/util.php";

    $dorayaki = new Dorayaki();

    if (isset($_POST["price"]) && isset($_POST["qty"]) && isset($_POST["id"])) {
        $res = $dorayaki->detail($_POST["id"]);
        if ($res->STOCK < $_POST["qty"]) {
            echo "quantity-exceed";
        } else if ($_POST["qty"] < 1) {
            echo "quantity-invalid";
        } else {
            echo "Rp" . formatPrice($_POST["price"] * $_POST["qty"]);
        }
    } else if (isset($_POST['id']) && isset($_POST['userid']) && isset($_POST['qty'])) {
        $dorayaki->buy($_POST['id'],$_POST['userid'],$_POST['qty']);
        $res = $dorayaki->detail($_POST['id']);
        echo $res->STOCK . " buah";
    }
?>