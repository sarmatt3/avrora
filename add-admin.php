<?php

require "php/db.php";
require "php/funcs.php";
if (!isset($_COOKIE["auth"]) || !isset($_COOKIE["verify"])) {
    $_SESSION['title'] = "Вход";
    $_SESSION["url"] = "login.php";
    header("Location: login.php");
} else {
    getData($_COOKIE["auth"], $_COOKIE["verify"]);
    if (!$_SESSION["verify"]){
        $_SESSION['title'] = "Вход";
    $_SESSION["url"] = "login.php";
    header("Location: login.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="system/img/logo.svg">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <form class="login-form" id="adm_form" method="post" action="">
        <div class="entry">
            <label for="">ФИО</label>
            <input type="text" id="fio">
        </div>
        <div class="entry">
            <label for="">Логин</label>
            <input type="text" id="login">
        </div>
        <div class="entry">
            <label for="">Уровень доступа</label>
            <input type="" id="prev">
        </div>
        <div class="entry">
            <label for="">Пароль</label>
            <input type="password" id="password">
        </div>
        
        <div class="entry">
            <label for="">Подтвердите пароль</label>
            <input type="password" id="r_password">
        </div>

        <div class="entry">
            <label for="">Пароль администратора <?= $_SESSION["lgn"] ?></label>
            <input type="password" id="adm_pass">
        </div>
        <div class="entry">
            <button type="submit">Добавить</button>
        </div>
        <p id="error"></p>

    </form>
    <div class="notif-popup" id="popup">
        <div class="icon" id="icon_d"><span class="material-icons" id="icon"></span></div>
        <p id="popuptext"></p>
    </div>

    <script src="js/admining.js"></script>
</body>

</html>