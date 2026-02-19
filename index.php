<?php
require_once("php/db.php");
require_once("php/funcs.php");

if (!isset($_COOKIE["auth"])){
    $_SESSION['title'] = "Вход";
    $_SESSION["url"] = "login.php";
}else{
    getData($_COOKIE["auth"]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="system/img/logo.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A V R O R A</title>
</head>

<body>
    <header>
        <nav>
            <img src="system/img/logo.svg" alt="">
        </nav>
        <nav>
            <a href="">Бронирование</a>
            <a href="">Рестораны</a>
            <a href="">Контакты</a>
        </nav>

        <nav>
            <a href=<?=$_SESSION["url"]?>><?=$_SESSION["title"]?></a>
        </nav>
    </header>
    <main>
        <div class="info">
            AVRORA - Забронируй место в ресторане в один клик!
        </div>

        <form action="">
            <div class="entry">
                <label for="">Ресторан</label>
                <select name="rest" id="rest">
                    <option value="">-- Выберите ресторан --</option>
                </select>
            </div>


            <div class="entry">
                <label for="">Дата и время</label>
                <select name="date-time" id="date-time" disabled>
                    <option value="">-- Сначала выберите ресторан --</option>
                </select>
            </div>

            <div class="entry">
                <label for="">ФИО</label>
                <input type="text" name="" id="fullname">
            </div>

            <div class="entry">
                <label for="">Телефон</label>
                <input type="text" name="" id="phone" placeholder="+7XXXXXXXXXX">
            </div>

            <button type="submit" id="book" >Забронировать</button>
        </form>
    </main>
</body>

</html>