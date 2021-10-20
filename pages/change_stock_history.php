<?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: " . "login.php");
    }
?>
<?php
    require_once "../app/dorayaki.php";

    $dorayaki = new Dorayaki();
    $res = $dorayaki->change_history($_SESSION["user"]["id"], $_SESSION["user"]["is_admin"]);

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
            <h2 class="page-header">Riwayat Perubahan</h2>
            <?php
                if ($_SESSION["user"]["is_admin"] == 1) {
                    echo '
                        <div class="flex-row">
                            <a href="purchase_history.php" class="unselected-link">
                                <p class="unselected-button" id="margin-right">Pembelian</p>
                            </a>
                            <p class="selected-button">Perubahan</p>
                        </div>
                    ';
                }
            ?>
        </div>
        <table class="change-table">
            <tr>
                <th>Varian</th>
                <th>Perubah</th>
                <th>Tanggal Perubahan</th>
                <th id="right-align">Jumlah Setelah Perubahan</th>
            </tr>
            <?php
                foreach ($res as $row) {
                    $variant = $row->VARIANT;
                    $changer = $row->CHANGER;
                    $change_date = $row->CHANGE_DATE;
                    $quantity = $row->QUANTITY;
                    $dorayaki_id = $row->DORAYAKI_ID;
                    echo "
                        <tr>
                            <td><a href='detail.php?id=$dorayaki_id' class='unselected-link variant'>$variant</a></td>
                            <td>$changer</td>
                            <td>$change_date</td>
                            <td id='right-align'>$quantity</td>
                        </tr>
                    ";
                }
            ?>
        </table>
    </div>
    <?php else: ?>
        <?php if ($_SESSION["user"]["is_admin"] == 0): ?>
        <div class="container-not-available">
            <img src="../assets/not_available.png"/>
            <p class="title">Halaman ini tidak tersedia</p>
            <p class="subtitle">Mari berselancar ke halaman lain!</p>
            <a href="index.php">
                <p class="button">Menu Utama</p>
            </a>
        </div>
        <?php else: ?>
        <div class="container-not-available">
            <img src="../assets/not_available.png"/>
            <p class="title">Ups, Riwayat perubahan kamu masih kosong.</p>
            <p class="subtitle">Mari merubah stok Doroyaki!</p>
            <a href="index.php">
                <p class="button">Menu Utama</p>
            </a>
        </div>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>