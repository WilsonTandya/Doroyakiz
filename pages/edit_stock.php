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

// REMINDER- static
$userid = 5;

if (isset($_POST['quantity'])){
    $res2 = $dorayaki->change_stock($id,$userid,$_POST['quantity']);
    if($res2) {
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
            <h2 class="page-header">Ubah Stok</h2>
        </div>
        <div class="row">
            <img class="purchase-image" src="../assets/dorayaki.jpeg" alt="Dorayaki" />
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
                <button name="submit-button" type="submit" form="purchase-form">
                    Ubah Stok
                </button>
            </div>
        </div>
    </div>
    </div>
</body>
</html>