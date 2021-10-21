<?php
    require_once "../app/dorayaki.php";
    require_once "../pages/util.php";

    $dorayaki = new Dorayaki();

    if (isset($_POST['qty']) && ($_POST["qty"] < 0)) {
        echo "quantity-invalid";
    }
    else if (isset($_POST['id']) && isset($_POST['userid']) && isset($_POST['qty'])) {
        $dorayaki->change_stock($_POST['id'],$_POST['userid'],$_POST['qty']);
        $res = $dorayaki->detail($_POST['id']);
        echo $res->STOCK . " buah";
    }
?>