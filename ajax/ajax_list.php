<?php
    require_once "../app/dorayaki.php";
    require_once "../pages/util.php";

    $dorayaki = new Dorayaki();

    if (isset($_POST["offset"]) && isset($_POST["nrecords"]) && isset($_POST["query"])) {
        $res = $dorayaki->search(strtolower($_POST["query"]),$_POST["offset"],$_POST["nrecords"]);
        $content = "";
        for ($i=0; $i<count($res); $i++) {
            $isFinalIndex = $i == count($res);
            $id = preprocess($res[$i]->ID);
            $sold = preprocess($res[$i]->SOLD);
            $name = preprocess($res[$i]->NAME);
            $description = preprocess($res[$i]->DESCRIPTION);
            $price = preprocess($res[$i]->PRICE);
            $stock = preprocess($res[$i]->STOCK);
            $content = $content .  "<list-card id=$id sold=$sold name=$name description=$description price=$price  stock=$stock final=$isFinalIndex></list-card>";
        }
        echo $content;
}

?>