<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/register.css">
    <script type="text/javascript" src="../data/books.js"></script>
    <script src="../components/navbar.js" type="text/javascript" defer></script>
    <title>Toko Buku</title>
</head>
<body>
    <div class="box">
        <h2 id="login-title">Registrasi</h2>
        <form action="../auth/sign-in.php" method="post">
            <div class="form-box" id="form-top">
                <p class="label">Email</p>
                <div class="search-box">
                    <input placeholder="Masukkan Email Anda" name="username" autocomplete="off"/>
                </div>
            </div>
            <div class="form-box" id="form-middle">
                <p class="label">Username</p>
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
            <input type="submit" class="inter" value="Daftar" name="submit"/>
        </form>
        <a href="login.php" class="register">Masuk</a>
    </div>
</body>
</html>