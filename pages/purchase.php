<?php
require_once "../app/dorayaki.php";
require_once "util.php";

$dorayaki = new Dorayaki();

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $res = $dorayaki->detail($id);
}

// REMINDER- static
$userid = 5;

if (isset($_POST['quantity'])){
    $res2 = $dorayaki->buy($id,$userid,$_POST['quantity']);
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
                <img src="../assets/icon-arrow-back.png" alt="Back" class="back-arrow" />
            </a>
            <h2 class="page-header">Beli</h2>
        </div>
        <div class="row">
            <img class="purchase-image" src="../assets/dorayaki.jpeg" alt="Dorayaki" />
            <div class="purchase-info">
                <h4 class="purchase-name"><?php echo $res->NAME ?></h4>
                <p class="purchase-stock">Stok: <span class="subtitle" name="purchase-stock"><?php echo $res->STOCK ?>
                        buah</span></p>
                <div class="row">
                    <p class="purchase-price" style="margin-right: auto;">Harga satuan</p>
                    <p class="purchase-price">Rp<?php echo formatPrice($res->PRICE) ?></p>
                </div>
                <div class="row" style="justify-content: center;">
                    <p class="purchase-price" style="margin-right: auto; margin-top: 25px;">Jumlah</p>
                    <form class="purchase-form" id="purchase-form" action=<?php echo "purchase.php?id=" . $id ?>
                        method="post" oninput="updateTotalPrice(event)">
                        <input type="number" name="quantity" min="1" step="1" value="1" />
                    </form>
                </div>
                <hr class="solid">
                <div class="row" style="margin-top: 25px;">
                    <span class="purchase-total" style="margin-right: auto;">Total harga</span>
                    <span class="purchase-total" name="purchase-total">Rp<?php echo formatPrice($res->PRICE) ?></span>
                </div>
                <button name="submit-button" type="submit" form="purchase-form">
                    Beli
                </button>
            </div>
        </div>
    </div>
    </div>
</body>

<script>
function updateTotalPrice(event) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let submitButton = document.getElementsByName("submit-button")[0]
            if (this.responseText == "quantity-error") {
                document.getElementsByName("purchase-total")[0].innerHTML = "Kuantitas pembelian melebih stok!"
                submitButton.disabled = true;
                submitButton.style.background = "#777";
                submitButton.style.cursor = "not-allowed";
            } else {
                document.getElementsByName("purchase-total")[0].innerHTML = this.responseText
                submitButton.disabled = false;
                submitButton.style.background = "#45b54a";
                submitButton.style.cursor = "pointer";
            }
        }
    };
    xhttp.open("POST", "../ajax/ajax_purchase.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    let priceVal = <?php echo $res->PRICE ?>;
    let qtyVal = document.getElementsByName("quantity")[0].value;
    let stock = <?php echo $res->STOCK ?>;
    let price = priceVal ? priceVal : 0;
    let qty = qtyVal ? qtyVal : 0;
    let param = `price=${price}&qty=${qty}&stock=${stock}`;
    xhttp.send(param);
}

function updateQuantity(event) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementsByName("purchase-stock")[0].innerHTML = this.responseText
        }
    };
    xhttp.open("POST", "../ajax/ajax_purchase.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    let id = <?php echo $id ?>;
    let param = `id=${id}`;
    xhttp.send(param);
}
</script>

</html>