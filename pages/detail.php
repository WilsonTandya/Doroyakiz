<?php
require_once "../app/dorayaki.php";
require_once "util.php";

// REMINDER- change to session
$isadmin = false;

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $dorayaki = new Dorayaki();
    $res = $dorayaki->detail($id);
    if($res == NULL) {
        header("Location: " . "detail_not_available.php");
    }
}

?>

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
            <a href="javascript:history.go(-1)">
                <img src="../assets/icon-arrow-back.png" alt="Back"
                    class="back-arrow" />
            </a>
            <h2 class="page-header">Detail</h2>
        </div>
        <div class="row">
            <img class="detail-image"
                src="../assets/dorayaki.jpeg"
                alt="Dorayaki" />
            <div class="detail-info">
                <h4 class="detail-name"><?php echo $res->NAME ?></h4>
                <div class="row" style="align-items: center;">
                    <p class="detail-sold">Terjual: <span class="subtitle"><?php echo $res->SOLD ?> buah</span></p>
                    <p class="detail-dot">•</p>
                    <p class="detail-stock">Stok: <span class="subtitle"><?php echo $res->STOCK ?> buah</span></p>
                </div>
                <h4 class="detail-price">Rp<?php echo formatPrice($res->PRICE) ?></h4>
                <hr class="solid">
                <p class="detail-desc">
                    <?php echo $res->DESCRIPTION ?>
                </p>
                <?php if ($isadmin): ?>
                    <div class="admin">
                            <!-- Bonus -->
                            <a href="#" id="Edit">
                                <button>Edit</button>
                            </a>
                            <!-- ------- -->
                            <a href=<?php echo "delete.php?id=" . $id ?> id="Delete">
                                <button>Delete</button>
                        </div>
                    </div>
                <?php else: ?>
                    <a href=<?php echo "purchase.php?id=" . $id ?>>
                        <button>Beli</button>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
</body>

</html>