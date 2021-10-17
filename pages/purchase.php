<?php
require_once "../app/dorayaki.php";
require_once "util.php";

$qty = 0;

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $dorayaki = new Dorayaki();
    $res = $dorayaki->detail($id);
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/purchase.css">
    <script src="../components/navbar.js" type="text/javascript" defer></script>
    <title>Doroyaki</title>
</head>

<body>
    <?php
        echo "<navbar-component></navbar-component>";
    ?>
    <div class="container">
        <div class="row" style="align-items: center;">
            <a href="javascript:history.go(-1)">
                <img src="../assets/icon-arrow-back.png" alt="Back"
                    class="back-arrow" />
            </a>
            <h2 class="page-header">Beli</h2>
        </div>
        <div class="row">
            <img class="purchase-image"
                src="../assets/dorayaki.jpeg"
                alt="Dorayaki" />
            <div class="purchase-info">
                <h4 class="purchase-name"><?php echo $res->NAME ?></h4>
                <p class="purchase-stock">Stok: <span class="subtitle"><?php echo $res->STOCK ?> buah</span></p>
                <div class="row">
                    <p class="purchase-price" style="margin-right: auto;">Harga satuan</p>
                    <p class="purchase-price">Rp<?php echo formatPrice($res->PRICE) ?></p>
                </div>
                <div class="row">
                    <p class="purchase-price" style="margin-right: auto;">Jumlah</p>
                    <form class="purchase-form" method="post">
                        <input type="number" id="quantity" name="qty" min="1" step="1" value=<?php echo $qty ?>>
                    </form>
                </div>
                <hr class="solid">
                <div class="row" style="margin-top: 25px;">
                    <p class="purchase-total" style="margin-right: auto;">Total harga</p>
                    <p class="purchase-total">Rp<?php echo formatPrice($res->PRICE * $qty) ?></p>
                </div>
                <button>Beli</button>
            </div>
        </div>
    </div>
    </div>
</body>

</html>