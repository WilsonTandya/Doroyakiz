<?php

if (isset($_POST["dorayaki_name"]) && isset($_POST["dorayaki_harga"])&&isset($_POST["dorayaki_stok"]) && isset($_POST["dorayaki_deskripsi"])){
    //$res = $dorayaki->add_dorayaki($id,$_POST['dorayaki_name'],$_POST['dorayaki_harga'],$_POST['dorayaki_stok'],$_POST['dorayaki_deskripsi']);
}

?>

<!DOCTYPE html>
<html>
<head>
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
        <form action="#" method="post">
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
                    <input type="number" placeholder="Masukkan Harga Dorayaki" type="dorayaki_harga" name="password" min=1 autocomplete="off"/>
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
            
            <input type="submit" class="inter" value="Submit" name="dorayaki_submit"/>
    </div>
    
</body>
</html>