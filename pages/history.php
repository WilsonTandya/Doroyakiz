<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/history.css">
    <script src="../components/navbar.js" type="text/javascript" defer></script>
    <script src="../components/history-card.js" type="text/javascript" defer></script>
    <title>Toko Buku</title>
</head>

<body>
    <?php
        echo "<navbar-component></navbar-component>";
    ?>
    <div class="container">
        <h2 class="page-header">Riwayat</h2>
        <?php
            for ($i=0;$i<3;$i++) {
                $isFinalIndex = $i == 2;
                echo "<history-card final=$isFinalIndex></history-card>";
            }
        ?>
    </div>
</body>

</html>