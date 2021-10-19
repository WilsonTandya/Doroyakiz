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
            <button class="btn-pagination before" onclick="updateDorayakiList('back')">&laquo;</button>
            <?php
                for ($i=1; $i<=$total_pages; $i++) {
                    if ($i == $page_no) {
                        echo "<button class='btn-pagination selected' onclick='updateDorayakiList($i)'>$i</button>";
                    } else {
                        echo "<button class='btn-pagination' onclick='updateDorayakiList($i)'>$i</button>";
                    }
                }
            ?>
            <button class="btn-pagination next" onclick="updateDorayakiList('next')">&raquo;</button>
        </div>
    </div>

    <script>
    function updateDorayakiList(type) {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let content = document.getElementsByClassName("list-content")[0];
                content.innerHTML = this.responseText
            }
        };
        xhttp.open("POST", "../ajax/ajax_list.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        let query = <?php echo "'" . $query . "'"; ?>;
        let pageno = <?php echo $page_no; ?>;
        let totalpages = <?php echo $total_pages; ?>;


        // REMINDER- TODO CHANGE PAGENO
        if (type == "next") {
            pageno = <?php echo $page_no + 1; ?>;
        } else if (type == "back") {
            pageno = <?php echo $page_no - 1; ?>;
        } else {
            pageno = type;
        }

        let btnNext = document.getElementsByClassName("btn-pagination next")[0]
        let btnBefore = document.getElementsByClassName("btn-pagination before")[0]

        if (pageno == totalpages) {
            btnNext.style.background = "rgba(0,0,0,0.3)";
            btnNext.style.color = "#FFF";
        } else {
            btnNext.style.background = "#FFF";
            btnNext.style.color = "#41b54a";
        }

        if (pageno == 1) {
            btnBefore.style.background = "rgba(0,0,0,0.3)";
            btnBefore.style.color = "#FFF";
        } else {
            btnBefore.style.background = "#FFF";
            btnBefore.style.color = "#41b54a";
        }

        let nrecords = <?php echo $n_records_per_page; ?>;
        let offset = (parseInt(pageno) - 1) * parseInt(nrecords);
        let param = `offset=${offset}&nrecords=${nrecords}&query=${query}`;
        xhttp.send(param);
    }
    </script>
</body>

</html>