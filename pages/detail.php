<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/detail.css">
    <script src="../components/navbar.js" type="text/javascript" defer></script>
    <title>Doroyaki</title>
</head>

<body>
    <?php
        echo "<navbar-component></navbar-component>";
    ?>
    <div class="container">
        <div class="row" style="align-items: center;">
            <a href="list.php">
                <img src="https://pixsector.com/cache/852dce6a/avb91899cb3246210ca63.png" alt="Back"
                    class="back-arrow" />
            </a>
            <h2 class="page-header">Detail</h2>
        </div>
        <div class="row">
            <img class="detail-image"
                src="https://asset.kompas.com/crops/8mYWlI9lPaf8F7XDmQOi2Rte9jo=/0x0:1000x667/750x500/data/photo/2021/07/23/60fa5f58ea527.jpg"
                alt="Product" />
            <div class="detail-info">
                <h4 class="detail-name">Doroyaki Norimitsu</h4>
                <div class="row" style="align-items: center;">
                    <p class="detail-sold">Terjual: <span class="subtitle">15 buah</span></p>
                    <p class="detail-dot">•</p>
                    <p class="detail-stock">Stok: <span class="subtitle">39 buah</span></p>
                </div>
                <h4 class="detail-price">Rp59.000</h4>
                <hr class="solid">
                <p class="detail-desc">
                    Dora The Explorer senang makan Dorayaki. Dorayaki lezat, enak, sehat
                    dan bergizi. Dorayaki penuh nutrisi dan kaya akan protein serta gula. Saya suka makan dorayaki.
                </p>
            </div>
        </div>
    </div>
    </div>
</body>

</html>