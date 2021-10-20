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

    $dorayaki = new Dorayaki();
    $res = $dorayaki->purchase_history($_SESSION["user"]["id"], $_SESSION["user"]["is_admin"]);
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
    <link rel="stylesheet" href="../styles/history.css">
    <link rel="stylesheet" href="../styles/not_available.css">
    <script src="../components/navbar.js" type="text/javascript" defer></script>
    <title>Riwayat Doroyaki</title>
</head>
<body>
    <?php
        echo "<navbar-component></navbar-component>";
    ?>
    <?php if ($res != null): ?>
    <div class="container">
        <div class="flex-row" id="flex-between">
            <h2 class="page-header">Riwayat Pembelian</h2>
            <?php
                if ($_SESSION["user"]["is_admin"] == 1) {
                    echo '
                        <div class="flex-row">
                            <p class="selected-button" id="margin-right">Pembelian</p>
                            <a href="change_stock_history.php" class="unselected-link">
                                <p class="unselected-button">Perubahan</p>
                            </a>
                        </div>
                    ';
                }
            ?>
        </div>
        <table class="purchase-table">
            <tr>
                <th>Varian</th>
                <th>Pembeli</th>
                <th>Tanggal Pembelian</th>
                <th id="center-align">Jumlah Beli</th>
                <th id="right-align">Total Harga</th>
            </tr>
            <?php
                foreach ($res as $row) {
                    $variant = $row->VARIANT;
                    $buyer = $row->BUYER;
                    $buy_date = $row->BUY_DATE;
                    $quantity = $row->QUANTITY;
                    $total = number_format(round($row->TOTAL),0,",",".");
                    $dorayaki_id = $row->DORAYAKI_ID;
                    echo "
                        <tr>
                            <td><a href='detail.php?id=$dorayaki_id' class='unselected-link variant'>$variant</a></td>
                            <td>$buyer</td>
                            <td>$buy_date</td>
                            <td id='center-align'>$quantity</td>
                            <td id='right-align'>$total</td>
                        </tr>
                    ";
                }
            ?>
        </table>
    </div>
    <?php else: ?>
    <div class="container-not-available">
        <img src="../assets/not_available.png"/>
        <p class="title">Ups, Riwayat pembelian kamu masih kosong.</p>
        <p class="subtitle">Mari membeli Doroyaki!</p>
        <a href="index.php">
            <p class="button">Menu Utama</p>
        </a>
    </div>
    <?php endif; ?>
</body>
</html>