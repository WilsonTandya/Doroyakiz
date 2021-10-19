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
    } else if (isset($_POST["pageno"]) && isset($_POST["totalpages"])) {

        /* START  FIRST PAGINATION */
        if ($_POST["pageno"] == 1) {
            echo "<button class='btn-pagination before-inactive' disabled>&laquo;</button>";
        } else {
            echo "<button class='btn-pagination' onclick='updateDorayakiList(" . '"back"' . ")'>&laquo;</button>";
        }

        if ($_POST["pageno"] != 1) {
            echo "<button class='btn-pagination' onclick='updateDorayakiList(" . '"first"' . ")'>...</button>";
        }
        /* END FIRST PAGINATION */
    
        /* START NUMBER PAGINATION */
        $first_shown_page = $_POST["pageno"] - 1;
        
        if ($first_shown_page < 1) {
            $first_shown_page = 1;
        }

        if ($_POST["pageno"] == 1) {
            $last_shown_page = $_POST["pageno"] + 2;
        } else {
            $last_shown_page = $_POST["pageno"] + 1;
        }

        if ($last_shown_page > $_POST["totalpages"]) {
            $last_shown_page = $_POST["totalpages"];
        }

        for ($i=$first_shown_page; $i<=$last_shown_page; $i++) {
            if ($i == $_POST["pageno"]) {
                echo "<button class='btn-pagination selected' onclick='updateDorayakiList($i)'>$i</button>";
            } else {
                echo "<button class='btn-pagination' onclick='updateDorayakiList($i)'>$i</button>";
            }
        }
        /* END NUMBER PAGINATION */
        
        /* START LAST PAGINATION */
        if ($_POST["pageno"] < $_POST["totalpages"] - 1) {
            echo "<button class='btn-pagination' onclick='updateDorayakiList(" . '"last"' . ")'>...</button>";
        }

        if ($_POST["pageno"] == $_POST["totalpages"]) {
            echo "<button class='btn-pagination next-inactive' disabled>&raquo;</button>";
        } else {
            echo "<button class='btn-pagination' onclick='updateDorayakiList(". '"next"' .")'>&raquo;</button>";
        }
        /* END LAST PAGINATION */
    }

?>