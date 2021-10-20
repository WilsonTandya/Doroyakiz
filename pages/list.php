<?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: " . "login.php");
    }
?>
<?php
require_once "../app/dorayaki.php";
require_once "util.php";

// constants
$page_no = 1;
$n_records_per_page = 5;
$offset = ($page_no - 1) * $n_records_per_page;

if (isset($_GET['query'])){
    $query = $_GET['query'];
} else {
    $query = "";
}

$dorayaki = new Dorayaki();
$total_records = $dorayaki->search_total_records(strtolower($query));
$total_pages = ceil($total_records/$n_records_per_page);
$res = $dorayaki->search(strtolower($query),$offset,$n_records_per_page);
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/list.css">
    <script src="../components/navbar.js" type="text/javascript" defer></script>
    <script src="../components/list-card.js" type="text/javascript" defer></script>
    <title>Doroyaki</title>
</head>

<body>
    <?php
        echo "<navbar-component></navbar-component>";
    ?>
    <div class="container">
        <h2 class="page-header">Hasil Pencarian: "<?php echo $query ?>"</h2>
        <div class="list-content">
            <?php
            for ($i=0; $i<count($res); $i++) {
                $isFinalIndex = $i == count($res);
                $id = preprocess($res[$i]->ID);
                $sold = preprocess($res[$i]->SOLD);
                $name = preprocess($res[$i]->NAME);
                $description = preprocess($res[$i]->DESCRIPTION);
                $price = preprocess($res[$i]->PRICE);
                $stock = preprocess($res[$i]->STOCK);
                echo "<list-card 
                        id=$id
                        sold=$sold 
                        name=$name 
                        description=$description 
                        price=$price 
                        stock=$stock 
                        final=$isFinalIndex
                    ></list-card>";
            }
            ?>
        </div>
        <?php if (count($res) == 0) {
            echo "<p>Dorayaki yang kamu cari tidak ditemukan.</p>";
        } ?>
        <div class="list-pagination">
            <button class="btn-pagination before-inactive" disabled">&laquo;</button>
            <?php
                $shown_pages = $total_pages-$total_pages%3;
                for ($i=1; $i<=$shown_pages; $i++) {
                    if ($i == $page_no) {
                        echo "<button class='btn-pagination selected' onclick='updateDorayakiList($i)'>$i</button>";
                    } else {
                        echo "<button class='btn-pagination' onclick='updateDorayakiList($i)'>$i</button>";
                    }
                }
            ?>
            <?php
                if ($total_pages == 0) {
                    echo "<button class='btn-pagination next-inactive' onclick='updateDorayakiList(" . '"next"' . ")''>&raquo;</button>";
                } else if ($total_pages == 1) {
                    echo "<button class='btn-pagination selected' onclick='updateDorayakiList(1)'>1</button>";
                    echo "<button class='btn-pagination next-inactive' onclick='updateDorayakiList(" . '"next"' . ")''>&raquo;</button>";
                } else {
                    echo "<button class='btn-pagination' onclick='updateDorayakiList(" . '"last"' . ")'>...</button>";
                    echo "<button class='btn-pagination next' onclick='updateDorayakiList(" . '"next"' . ")''>&raquo;</button>";
                }
            ?>
        </div>
    </div>

    <script>
    function updateDorayakiList(type) {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let content = document.getElementsByClassName("list-content")[0];
                content.innerHTML = this.responseText
                generatePagination(pageno)
            }
        };
        xhttp.open("POST", "../ajax/ajax_list.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        let query = <?php echo "'" . $query . "'"; ?>;
        let pageno = parseInt(document.getElementsByClassName('btn-pagination selected')[0].innerHTML);
        let totalpages = <?php echo $total_pages; ?>;


        // REMINDER- TODO CHANGE PAGENO
        if (type == 'next') {
            pageno += 1;
        } else if (type == 'back') {
            pageno -= 1;
        } else if (type == 'first') {
            pageno = 1;
        } else if (type == 'last') {
            pageno = totalpages;
        } else {
            pageno = type;
        }

        let nrecords = <?php echo $n_records_per_page; ?>;
        let offset = (parseInt(pageno) - 1) * parseInt(nrecords);
        let param = `offset=${offset}&nrecords=${nrecords}&query=${query}`;
        xhttp.send(param);
    }

    function generatePagination(pageno) {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let pagination = document.getElementsByClassName("list-pagination")[0];
                pagination.innerHTML = this.responseText
            }
        };
        xhttp.open("POST", "../ajax/ajax_list.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        let totalpages = <?php echo $total_pages; ?>;
        let param = `pageno=${pageno}&totalpages=${totalpages}`;
        xhttp.send(param);
    }
    </script>
</body>

</html>