<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/list.css">
    <script src="../components/navbar.js" type="text/javascript" defer></script>
    <script src="../components/list-card.js" type="text/javascript" defer></script>
    <title>Document</title>
</head>

<body>
    <?php
        echo "<navbar-component></navbar-component>";
    ?>
    <div class="container">
        <h2 class="page-header">Top 10 Dorayaki</h2>
        <?php
            for ($i=0;$i<10;$i++) {
                $isFinalIndex = $i == 9;
                echo "<list-card final=$isFinalIndex></list-card>";
            }
        ?>
    </div>
</body>

</html>