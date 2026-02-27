<?php
require_once("php/db.php");
require_once("php/funcs.php");

if (!isset($_COOKIE["auth"])) {
    $_SESSION['title'] = "Вход";
    $_SESSION["url"] = "login.php";
} else {
    getData($_COOKIE["auth"]);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="system/img/logo-b.svg">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>К О Н Т А К Т Ы</title>
</head>

<body>
    <header>
        <nav class="menu">
            <button onclick="header_menu.style.display = 'block'"><span class="material-icons">menu</span></button>
        </nav>

        <nav class="logo">
            <img src="system/img/logo.svg" alt="">
        </nav>

        <nav>
            <a href="index.php">Бронирование</a>
            <a href="restaurants.php">Рестораны</a>
            <a href="contacts.php" style="text-decoration: underline; font-weight: bold;">Контакты</a>
        </nav>

        <nav class="login-btn">
            <a href=<?= $_SESSION["url"] ?>><?= $_SESSION["title"] ?></a>
        </nav>
    </header>
    <div id="header_menu">
        <nav>
            <button onclick="header_menu.style.display = 'none'"><span class="material-icons">close</span></button>
            <a href="index.php" >Бронирование</a>
            <a href="restaurants.php">Рестораны</a>
            <a href="contacts.php" style="text-decoration: underline; font-weight: bold; transition: trnslateX(5px);">Контакты</a>

        </nav>
    </div>

    <div class="contacts">
        <div class="c-card">
            <span class="material-icons">alternate_email</span>
            <h1>Электроннная почта</h1>
            <p>avrora.help@mail.ru</p>
            <div><a class="a-contact-btn"
                    href="mailto:avrora.help@mail.ru?subject=Обращение к администрации AVRORA">Написать письмо</a></div>
        </div>

        <div class="c-card">
            <span class="material-icons">call</span>
            <h1>Телефон</h1>
            <p>+7 (867) 277-95-77</p>
            <div><a class="a-contact-btn tel" href="tel:+78672779577">Позвонить</a></div>
        </div>

        <div class="c-card">
            <span class="material-icons">chat</span>
            <h1>Телеграм-бот</h1>
            <p>@avrora_booling_bot</p>
            <div><a class="a-contact-btn bot" href="https://t.me/avrora_booling_bot">Бот</a></div>
        </div>
    </div>

    <form action="" class="advise">
        <h3>Свяжитесь с нами!</h3>

        <div class="entry">
            <label for="">Имя</label>
            <input type="text" id="name_adv">
        </div>

        <div class="entry">
            <label for="">Почта</label>
            <input type="text" id="email">
        </div>

        <div class="entry">
            <label for="">Сообщение</label>
            <textarea name="" id="advise"></textarea>
        </div>

        <button type="submit" class="send">Отправить</button>
    </form>
</body>

</html>