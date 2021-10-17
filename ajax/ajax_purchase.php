<?php
    require_once "../pages/util.php";

    echo formatPrice($_POST["price"] * $_POST["qty"]);
?>