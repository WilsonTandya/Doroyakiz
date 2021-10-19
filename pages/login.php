<?php
    require_once "../app/account.php";

    $account = new Account();
    
    $login_fail = false;
    
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $res = $account->login($username, $password);
        if ($res != NULL) {
            session_start();
            $_SESSION["user"] = array("id" => $res->ID, "username" => $res->USERNAME, "is_admin" => $res->ISADMIN);
            header("Location: " . "index.php");
        }
        else {
            $login_fail = true;
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
    <link rel="stylesheet" href="../styles/login.css">
    <script src="../components/navbar.js" type="text/javascript" defer></script>
    <title>Doroyaki</title>
</head>
<body>
    <div class="box">
        <script>
            function handleChangeFormLogin(event) {
                var usernameValue = document.getElementsByName("username")[0].value;
                var passwordValue = document.getElementsByName("password")[0].value;
                console.log(usernameValue, passwordValue);
                if (usernameValue != "" && passwordValue != "") {
                    document.getElementById("login-button").className = "inter";
                    document.getElementById("login-button").disabled = false;
                }
                else {
                    document.getElementById("login-button").className = "inter-disabled";
                    document.getElementById("login-button").disabled = true;
                }
            }
        </script>
        <h2 id="login-title">Login</h2>
        <form action="login.php" method="post" oninput="handleChangeFormLogin(event)">
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
                if ($login_fail) {
                    $message = "Username dan password tidak cocok";
                    echo "<p style='color: #D9534F; font-size: .9rem'>$message</p>";
                }
            ?>
            <input type="submit" class="inter-disabled" value="Masuk" name="submit" id="login-button" disabled/>
        </form>
        <a href="register.php" class="register">Daftar</a>
    </div>
</body>
</html>