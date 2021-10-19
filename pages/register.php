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
    <title>Doroyaki</title>
</head>
<body>
    <div class="box">
        <h2 id="login-title">Registrasi</h2>
        <script>
            function handleChangeFormRegister(event) {
                var emailValue = document.getElementsByName("email")[0].value;
                var fullnameValue = document.getElementsByName("fullname")[0].value;
                var usernameValue = document.getElementsByName("username")[0].value;
                var passwordValue = document.getElementsByName("password")[0].value;
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if (emailValue != "" && fullnameValue != "" && usernameValue != "" && passwordValue != ""
                            && this.responseText == "register-enabled") {
                            document.getElementById("register-button").className = "inter";
                            document.getElementById("register-button").disabled = false;
                        }
                        else {
                            document.getElementById("register-button").className = "inter-disabled";
                            document.getElementById("register-button").disabled = true;
                        }
                    }
                };
                xhttp.open("POST", "../ajax/ajax_register.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var email = emailValue != "" ? emailValue : "empty";
                var username = usernameValue != "" ? usernameValue : "empty";
                var param = `email=${email}&username=${username}&validate=all`;
                xhttp.send(param);
            }
            
            function validateEmail(event) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText == "email-empty") {
                            document.getElementById("email-box").style.border = "1px solid rgba(49,53,59,0.4)";
                            document.getElementById("email-error").style.display = "none";
                            document.getElementById("email-success").style.display = "none";
                        }
                        else if (this.responseText == "email-valid") {
                            document.getElementById("email-box").style.border = "1px solid #41B54A";
                            document.getElementById("email-error").style.display = "none";
                            document.getElementById("email-success").style.display = "block";
                        }
                        else {
                            document.getElementById("email-box").style.border = "1px solid #d8414a";
                            document.getElementById("email-error").style.display = "block";
                            document.getElementById("email-success").style.display = "none";
                        }
                    }
                };
                xhttp.open("POST", "../ajax/ajax_register.php", true);
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
                            document.getElementById("username-success").style.display = "none";
                        }
                        else if (this.responseText == "username-valid") {
                            document.getElementById("username-box").style.border = "1px solid #41B54A";
                            document.getElementById("username-error").style.display = "none";
                            document.getElementById("username-success").style.display = "block";
                        }
                        else {
                            document.getElementById("username-box").style.border = "1px solid #d8414a";
                            document.getElementById("username-error").style.display = "block";
                            document.getElementById("username-success").style.display = "none";
                        }
                    }
                };
                xhttp.open("POST", "../ajax/ajax_register.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var value = event.target.value != "" ? event.target.value : "empty";
                var param = `username=${value}&validate=username`;
                xhttp.send(param);
            }
        </script>
        <form action="register.php" method="post" oninput="handleChangeFormRegister(event)">
            <div class="form-box" id="form-top">
                <p class="label">Email</p>
                <div class="search-box" id="email-box">
                    <input placeholder="Masukkan Email Anda" name="email" autocomplete="off" oninput="validateEmail(event)"/>
                </div>
                <p class="input-error" id="email-error">Email tidak valid</p>
                <p class="input-success" id="email-success">Email tersedia</p>
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
                <p class="input-success" id="username-success">Username tersedia</p>
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
            <input type="submit" class="inter-disabled" value="Daftar" id="register-button" name="submit" disabled/>
        </form>
        <a href="login.php" class="register">Masuk</a>
    </div>
</body>
</html>