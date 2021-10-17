<?php
    require_once "../app/dorayaki.php";
    require_once "../pages/util.php";

    $dorayaki = new Dorayaki();

    if (isset($_POST["price"]) && isset($_POST["qty"]) && isset($_POST["stock"])) {
        if ($_POST["stock"] < $_POST["qty"]) {
            echo "quantity-error";
        } else {
            echo "Rp" . formatPrice($_POST["price"] * $_POST["qty"]);
        }
    } else if (isset($_POST["id"])) {
        $res = $dorayaki->detail($_POST["id"]);
        echo $res->STOCK;
    }
?>