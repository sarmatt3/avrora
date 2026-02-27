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
    <title>A V R O R A</title>
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
            <a href="index.php" style="text-decoration: underline">Бронирование</a>
            <a href="restaurants.php">Рестораны</a>
            <a href="contacts.php">Контакты</a>
        </nav>

        <nav class="login-btn">
            <a href=<?= $_SESSION["url"] ?>><?= $_SESSION["title"] ?></a>
        </nav>
    </header>
    <main>
        <div class="info">
            AVRORA - Забронируй место в ресторане в один клик!
        </div>

        <form id="booking-form">
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
                    $result->close() ?>
                </select>
            </div>


            <div class="entry">
                <label for="">Дата</label>
                <select name="date-time" id="date-time" disabled>
                    <option value="">-- Сначала выберите ресторан --</option>
                </select>
            </div>

            <div class="entry">
                <label for="">Время</label>
                <select name="time" id="time" disabled>
                    <option value="">-- Сначала выберите дату --</option>
                </select>
            </div>

            <div class="entry">
                <label for="">ФИО</label>
                <input type="text" name="" id="fullname" required>
            </div>

            <div class="entry">
                <label for="">Телефон</label>
                <input type="text" name="" id="phone" placeholder="+7XXXXXXXXXX" required>
            </div>

            <button type="submit" id="book">Забронировать</button>
        </form>
    </main>

    <div id="notification" onclick="this.style.display = 'none'">
        <div class="content">
            <span class="material-icons">check_circle</span>
            <h1>Успешно!</h1>
            <div class="text">
                <p id="rest-p"></p>
                <p id="date-time-p"></p>
                <p id="address-p"></p>
                <p id="code-p"></p>
            </div>
            <p id="" style="font-size: 16px; opacity: 50%;">Сделайте снимок экрана, чтобы сохранить код бронирования и QR-код</p>
            <button onclick="notification.style.display = 'none'">Закрыть</button>
        </div>
    </div>

    <div id="header_menu">
        <nav>
            <button onclick="header_menu.style.display = 'none'"><span class="material-icons">close</span></button>
            <a href="index.php" style="text-decoration: underline">Бронирование</a>
            <a href="restaurants.php">Рестораны</a>
            <a href="contacts.php">Контакты</a>

        </nav>
    </div>

    <script src="js/booking.js"></script>
</body>

</html>