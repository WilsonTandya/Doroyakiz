<?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: " . "login.php");
    }
?>
<?php

    require_once "../app/dorayaki.php";
    require_once "util.php";

    $dorayaki = new Dorayaki();

    if (isset($_POST["dorayaki_name"]) && isset($_POST["dorayaki_harga"])&&isset($_POST["dorayaki_stok"]) && isset($_POST["dorayaki_deskripsi"])){
        $name = $_POST["dorayaki_name"];
        $price = $_POST["dorayaki_harga"];
        $qty = $_POST["dorayaki_stok"];
        $desc = $_POST["dorayaki_deskripsi"];

        $res = $dorayaki->add_dorayaki($name, $price, $qty, $desc);
        if($res) {
            header("Location: " . "index.php");
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/add_variant.css">
    <script src="../components/navbar.js" type="text/javascript" defer></script>
    <title>Doroyaki</title>
</head>
<body>
    <?php
        echo "<navbar-component></navbar-component>";
    ?>
    <div class="box">
        <h2 class="add_variant-title">Menambah Varian Dorayaki</h2>
        <form action="add_variant.php" method="post">
            <div class="form-box" id="form-top">
                <p class="label">Nama Dorayaki</p>
                <div class="search-box">
                    <input placeholder="Masukkan Nama Dorayaki" name="dorayaki_name" autocomplete="off"/>
                </div>
            </div>
            <div class="form-box" id="form-middle">
                <p class="label">Harga</p>
                <div class="harga-box">
                <div class="left-icon">Rp</div>
                    <input type="number" placeholder="Masukkan Harga Dorayaki" name="dorayaki_harga" min=1 autocomplete="off"/>
                </div>
            </div>
            <div class="form-box" id="form-middle">
                <p class="label">Stok</p>
                <div class="search-box">
                    <input type="number" placeholder="Masukkan Stok Dorayaki" name="dorayaki_stok" min=1 autocomplete="off"/>
                </div>
            </div>
            <div class="form-box" id="form-middle">
                <p class="label">Deskripsi</p>
                <div class="search-box">
                    <input placeholder="Masukkan Deskripsi Dorayaki" name="dorayaki_deskripsi" autocomplete="off"/>
                </div>
            </div>
            <div class="form-box" id="form-bottom">
                <p class="label">Gambar</p>
                <div class="deskripsi-box">
                <input type="file" name="fileToUpload" id="fileToUpload"/>
                </div>
            </div>
            <input type="submit" class="inter" value="Tambah" name="dorayaki_submit"/>
        </form>
    </div>
</body>
</html>