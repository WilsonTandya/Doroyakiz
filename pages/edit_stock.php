<?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: " . "login.php");
    }

    //check expiry time
    ob_start();
    if (isset($_SESSION["login"])) {

        if ($_SESSION["data"]["time"] < time()) { 
            $_SESSION["login"] = false;
            header('Location: login.php');
            exit();
        }
    }
    ob_end_flush();
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/purchase.css">
    <link rel="stylesheet" href="../styles/not-available.css">
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
            <h2 class="page-header">Ubah Stok</h2>
        </div>
        <div class="row">
            <img class="purchase-image" src=<?php echo "../assets/dorayaki/" . $res->IMG_FILE ?> alt="Dorayaki" />
            <div class="purchase-info">
                <h4 class="purchase-name"><?php echo $res->NAME ?></h4>
                <p class="purchase-stock">Stok: <span class="subtitle" name="purchase-stock"><?php echo $res->STOCK ?>
                        buah</span></p>
                <div class="row" style="justify-content: center;">
                    <p class="purchase-price" style="margin-right: auto; margin-top: 25px;">Jumlah Stok Baru</p>
                    <form class="purchase-form" id="purchase-form" action=<?php echo "edit_stock.php?id=" . $id ?>
                        method="post">
                        <input type="number" name="quantity" min="0" step="1" value="1" />
                    </form>
                </div>
                <hr class="solid">
                <button name="submit-button" onclick="ubah_stok(event)">
                    Ubah Stok
                </button>
                <p class="purchase-success"></p>
            </div>
        </div>
    </div>
    </div>
</body>

<script>
    function ubah_stok(event) {
    let xhttp = new XMLHttpRequest();
    let qtyVal = document.getElementsByName("quantity")[0].value;
    let qty = qtyVal ? qtyVal : 0;
    let id = <?php echo $id; ?>;
    let userid = <?php echo $userid; ?>;
    let param = `id=${id}&userid=${userid}&qty=${qty}`;
    xhttp.onreadystatechange = function() {
        let btnSubmit = document.getElementsByName("submit-button")[0]
        let textPurchaseSuccess = document.getElementsByClassName("purchase-success")[0]
        btnSubmit.innerHTML = "Sedang mengubah..."
        btnSubmit.disabled = true
        btnSubmit.style.cursor = "not-allowed"
        btnSubmit.style.background = "rgba(0,0,0,0.3)"
        textPurchaseSuccess.innerHTML = "Memproses"
        if (this.readyState == 4 && this.status == 200) {
            document.getElementsByName("purchase-stock")[0].innerHTML = this.responseText
            textPurchaseSuccess.innerHTML = `*Stok dorayaki berhasil diubah!`
            btnSubmit.innerHTML = "Ubah Stok"
            btnSubmit.disabled = false
            btnSubmit.style.cursor = "pointer"
            btnSubmit.style.background = "#45b54a"
        }
    };
    xhttp.open("POST", "../ajax/ajax_edit_stock.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(param);
}
</script>
</html>