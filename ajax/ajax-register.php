<?php
    require_once "../pages/util.php";
    require_once "../app/account.php";

    if ($_POST["validate"] == "all") {
        $account = new Account();
        if ($_POST["email"] != "empty" && $_POST["username"] != "empty") {
            if (isEmailValid($_POST["email"]) && $account->isUsernameAvailable($_POST["username"])) {
                echo "register-enabled";
            }
        }
    }
    else if ($_POST["validate"] == "email") {
        if ($_POST["email"] == "empty") {
            echo "email-empty";
        }
        else if (isEmailValid($_POST["email"])) {
            echo "email-valid";
        }
        else {
            echo "email-invalid";
        }
    }
    else {
        $account = new Account();
        if ($_POST["username"] == "empty") {
            echo "username-empty";
        }
        else if ($account->isUsernameAvailable($_POST["username"])) {
            echo "username-valid";
        }
        else {
            echo "username-taken";
        } 
    }
?>