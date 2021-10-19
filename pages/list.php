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

        <button onclick="updateDorayakiList('back')">
            <a href="#">Back</a>
        </button>
        <button onclick="updateDorayakiList('next')">
            <a href="#">Next</a>
        </button>
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
    </div>

    <script>
    function updateDorayakiList(type) {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // let response = JSON.parse(this.responseText);
                console.log(this.responseText)
            }
        };
        xhttp.open("POST", "../ajax/ajax_list.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        let query = <?php echo "'" . $query . "'"; ?>;
        let pageno = <?php echo $page_no; ?>;

        if (type == "next") {
            pageno = <?php echo $page_no + 1; ?>;
        } else {
            pageno = <?php echo $page_no - 1; ?>;
        }
        let nrecords = <?php echo $n_records_per_page; ?>;
        let offset = (parseInt(pageno) - 1) * parseInt(nrecords);
        let param = `offset=${offset}&nrecords=${nrecords}&query=${query}`;
        xhttp.send(param);
    }
    </script>
</body>

</html>