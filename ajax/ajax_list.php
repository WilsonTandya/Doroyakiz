<?php
    require_once "../app/dorayaki.php";
    require_once "../pages/util.php";

    $dorayaki = new Dorayaki();

    if (isset($_POST["offset"]) && isset($_POST["nrecords"]) && isset($_POST["query"])) {
        $res = $dorayaki->search(strtolower($_POST["query"]),$_POST["offset"],$_POST["nrecords"]);
        echo json_encode($res);
    }

?>