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
            <a href="index.php">Бронирование</a>
            <a href="restaurants.php">Рестораны</a>
            <a href="contacts.php">Контакты</a>
        </nav>

        <nav>
            <a href=<?= $_SESSION["url"] ?>><?= $_SESSION["title"] ?></a>
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
                    <?php
                    $sql = "SELECT name, id FROM restaurants";
                    $result = mysqli_query($conn, $sql);
                    while ($rest = $result->fetch_assoc()): ?>
                        <option value=<?= $rest['id'] ?>><?= $rest['name'] ?></option>
                    <?php endwhile;
                    $result -> close() ?>
                </select>
            </div>


            <div class="entry">
                <label for="">Дата и время</label>
                <select name="date-time" id="date-time" disabled>
                    <option value="">-- Сначала выберите ресторан --</option>
                    <?php
                    $sql = "SELECT id, date, time, address FROM free_places";
                    $result = mysqli_query($conn, $sql);
                    while ($date = $result->fetch_assoc()): ?>
                        <option value=<?= $date['id'] ?>><?= $date['date'] . " " . $date["time"]?></option>
                    <?php endwhile;
                    $result -> close() ?>
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

            <button type="submit" id="book">Забронировать</button>
        </form>
    </main>
</body>

</html>