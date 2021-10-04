<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/login.css">
    <script type="text/javascript" src="../data/books.js"></script>
    <script src="../components/navbar.js" type="text/javascript" defer></script>
    <title>Toko Buku</title>
</head>
<body>
    <div class="box">
        <h2 id="login-title">Login</h2>
        <form action="../auth/sign-in.php" method="post">
            <div class="form-box" id="form-top">
                <p class="label">Username atau Email</p>
                <div class="search-box">
                    <input placeholder="Masukkan Username Anda" name="username" autocomplete="off"/>
                </div>
            </div>
            <div class="form-box" id="form-bottom">
                <p class="label">Password</p>
                <div class="search-box">
                    <input placeholder="Masukkan Password Anda" type="password" name="password"/>
                </div>
            </div>
            <?php
                if (isset($_POST["login-failed-message"])) {
                    $message = $_POST["login-failed-message"];
                    echo "<p style='color: #D9534F;'>$message</p>";
                }
            ?>
            <input type="submit" class="inter" value="Masuk" name="submit"/>
        </form>
        <a href="register.php" class="register">Daftar</a>
    </div>
</body>
</html>