<?php
    require_once "../app/account.php";
    require_once "util.php";

    $account = new Account();
    
    $register_fail = false;
    
    if (isset($_POST["email"]) && isset($_POST["fullname"]) && isset($_POST["username"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $fullname = $_POST["fullname"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $res = $account->register($email, $fullname, $username, $password);
        if ($res) {
            session_start();
            $_SESSION["username"] = $username;
            header("Location: " . "index.php");
        }
        else {
            $register_fail = true;
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/register.css">
    <script src="../components/navbar.js" type="text/javascript" defer></script>
    <title>Toko Buku</title>
</head>
<body>
    <div class="box">
        <h2 id="login-title">Registrasi</h2>
        <script>
            function validateEmail(event) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText == "email-empty") {
                            document.getElementById("email-box").style.border = "1px solid rgba(49,53,59,0.4)";
                            document.getElementById("email-error").style.display = "none";
                        }
                        else if (this.responseText == "email-valid") {
                            document.getElementById("email-box").style.border = "1px solid #41B54A";
                            document.getElementById("email-error").style.display = "none";
                        }
                        else {
                            document.getElementById("email-box").style.border = "1px solid #d8414a";
                            document.getElementById("email-error").style.display = "block";
                        }
                    }
                };
                xhttp.open("POST", "../ajax/ajax-register.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var value = event.target.value != "" ? event.target.value : "empty";
                var param = `email=${value}&validate=email`;
                xhttp.send(param);
            }

            function validateUsername(event) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText)
                        if (this.responseText == "username-empty") {
                            document.getElementById("username-box").style.border = "1px solid rgba(49,53,59,0.4)";
                            document.getElementById("username-error").style.display = "none";
                        }
                        else if (this.responseText == "username-valid") {
                            document.getElementById("username-box").style.border = "1px solid #41B54A";
                            document.getElementById("username-error").style.display = "none";
                        }
                        else {
                            document.getElementById("username-box").style.border = "1px solid #d8414a";
                            document.getElementById("username-error").style.display = "block";
                        }
                    }
                };
                xhttp.open("POST", "../ajax/ajax-register.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var value = event.target.value != "" ? event.target.value : "empty";
                var param = `username=${value}&validate=username`;
                xhttp.send(param);
            }
        </script>
        <form action="register.php" method="post">
            <div class="form-box" id="form-top">
                <p class="label">Email</p>
                <div class="search-box" id="email-box">
                    <input placeholder="Masukkan Email Anda" name="email" autocomplete="off" oninput="validateEmail(event)"/>
                </div>
                <p class="input-error" id="email-error">Email tidak valid</p>
            </div>
            <div class="form-box" id="form-middle">
                <p class="label">Nama lengkap</p>
                <div class="search-box">
                    <input placeholder="Masukkan Nama Lengkap Anda" name="fullname" autocomplete="off"/>
                </div>
            </div>
            <div class="form-box" id="form-middle">
                <p class="label">Username</p>
                <div class="search-box" id="username-box">
                    <input placeholder="Masukkan Username Anda" name="username" autocomplete="off" oninput="validateUsername(event)"/>
                </div>
                <p class="input-error" id="username-error">Username tidak tersedia</p>
            </div>
            <div class="form-box" id="form-bottom">
                <p class="label">Password</p>
                <div class="search-box">
                    <input placeholder="Masukkan Password Anda" type="password" name="password"/>
                </div>
            </div>
            <?php
                if ($register_fail) {
                    $message = "Registrasi gagal";
                    echo "<p style='color: #d8414a;'>$message</p>";
                }
            ?>
            <input type="submit" class="inter" value="Daftar" name="submit"/>
        </form>
        <a href="login.php" class="register">Masuk</a>
    </div>
</body>
</html>