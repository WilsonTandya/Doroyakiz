<?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: " . "login.php");
    }
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/detail_not_available.css">
    <script src="../components/navbar.js" type="text/javascript" defer></script>
    <title>Doroyaki</title>
</head>

<body>
    <?php
        echo "<navbar-component></navbar-component>";
    ?>
    <div class="container">
        <img src="../assets/detail_not_available.png"/>
        <p class="title">Maaf, Doroyaki tidak tersedia</p>
        <p class="subtitle">Mari cari Doroyaki yang lain!</p>
        <a href="index.php">
            <p class="button">Menu Utama</p>
        </a>
    </div>
</body>

</html>