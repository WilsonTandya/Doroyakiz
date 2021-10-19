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

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $res = $dorayaki->detail($id);
}

$userid = $_SESSION["user"]["id"];

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
                    <form class="purchase-form" id="purchase-form" oninput="updateTotalPrice(event)">
                        <input type="number" name="quantity" min="1" step="1" value="1" />
                    </form>
                </div>
                <hr class="solid">
                <div class="row" style="margin-top: 25px;">
                    <span class="purchase-total" style="margin-right: auto;">Total harga</span>
                    <span class="purchase-total" name="purchase-total">Rp<?php echo formatPrice($res->PRICE) ?></span>
                </div>
                <button name="submit-button" onclick="buy(event)">
                    Beli
                </button>
                <p class="purchase-success"></p>
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
            if (this.responseText == "quantity-exceed") {
                document.getElementsByName("purchase-total")[0].innerHTML = "Kuantitas pembelian melebih stok!"
                submitButton.disabled = true;
                submitButton.style.background = "#777";
                submitButton.style.cursor = "not-allowed";
            } else if (this.responseText == "quantity-invalid") {
                document.getElementsByName("purchase-total")[0].innerHTML = "Kuantitas pembelian tidak valid!"
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

function buy(event) {
    let xhttp = new XMLHttpRequest();
    let qtyVal = document.getElementsByName("quantity")[0].value;
    let qty = qtyVal ? qtyVal : 0;
    let id = <?php echo $id; ?>;
    let userid = <?php echo $userid; ?>;
    let param = `id=${id}&userid=${userid}&qty=${qty}`;
    xhttp.onreadystatechange = function() {
        document.getElementsByName("submit-button")[0].innerHTML = "Sedang membeli..."
        if (this.readyState == 4 && this.status == 200) {
            document.getElementsByName("submit-button")[0].innerHTML = "Beli"
            document.getElementsByName("purchase-stock")[0].innerHTML = this.responseText
            document.getElementsByClassName("purchase-success")[0].innerHTML =
                `*Pembelian ${qty} buah dorayaki berhasil!`
        }
    };
    xhttp.open("POST", "../ajax/ajax_purchase.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(param);
}
</script>

</html>