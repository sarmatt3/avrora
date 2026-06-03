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
            <a href="index.php" class="checked_h">Бронирование</a>
            <a href="restaurants.php">Рестораны</a>
            <a href="contacts.php">Контакты</a>
        </nav>

        <nav class="login-btn">
            <a href=<?= $_SESSION["url"] ?>><?= $_SESSION["title"] ?></a>
        </nav>
    </header>
    <main>
        <div class="info">
            <h1>AVRORA — ресторан, который ждёт вас в один клик.</h1><br>
            <p>Представьте: вы хотите вкусно поужинать, но бронирование столика превращается в квест со звонками и ожиданием у телефона. В AVRORA мы решили это исправить. Наш сервис создан для тех, кто ценит своё время. Забудьте о долгих согласованиях. Теперь достаточно одного касания, чтобы забронировать лучший столик для романтического свидания, деловой встречи или ужина с друзьями. Просто выберите дату, время и количество гостей. Один клик, и место уже ваше. Никаких лишних форм, паролей и подтверждений. AVRORA — это новый стандарт гостеприимства. Быстро, удобно, элегантно. Ваш вечер начинается здесь. Забронируйте место прямо сейчас.</p>
        </div>

        <form id="booking-form">
            <div class="entry">
                <label for="">Ресторан</label>
                <select name="rest" id="rest">
                    <option value="">-- Выберите ресторан --</option>
                    <?php
                    $sql = "SELECT name FROM restaurants WHERE status = 'active'";
                    $result = mysqli_query($conn, $sql);
                    while ($rest = $result->fetch_assoc()): ?>
                        <option value=<?= $rest['name'] ?>><?= $rest['name'] ?></option>
                    <?php endwhile;
                    $result->close() ?>
                </select>
            </div>


            <div class="entry">
                <label for="date">Дата</label>
                <select name="date" id="date" disabled>
                    <option value="">-- Сначала выберите ресторан --</option>
                </select>
            </div>

            <div class="entry">
                <label for="time">Время</label>
                <select name="time" id="time" disabled>
                    <option value="">-- Сначала выберите дату --</option>
                </select>
            </div>

            <div class="entry">
                <label for="table">Стол</label>
                <select name="time" id="table" disabled>
                    <option value="">-- Сначала выберите время --</option>
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

            <div class="entry" style="display: flex;">
                <input style="width: auto" type="checkbox" id="acception" required>
                <label style="width: auto" for="acception">Даю согласие на обработку ПД</label>
            </div>

            <button type="submit" id="book">Забронировать</button>
        </form>
    </main>


    <main class="grid-2">
    <form id="unbooking">
        <h2 style="color: #fff">Отменить бронь</h2><br>
        <div class="entry">
            <label for="code-unbooking">Код бронирования</label>
            <input type="text" id="code-unbooking">
        </div>

        <div class="entry">
            <label for="phone-unbooking">Телефон</label>
            <input type="text" id="phone-unbooking">
        </div>

        <button type="submit" class="cancel-color">Отменить бронь</button>
        <p id="error"></p>
    </form>


    <form id="search">
        <h2 style="color: #fff">Найти бронь</h2><br>
        <div class="entry">
            <label for="phone_sr">Телефон</label>
            <input type="text" id="phone_sr">
        </div>

        <button type="submit" class="cancel-color">Найти бронь</button>
        <p id="error"></p>
    </form>
    </main>

    <div id="notification" >
        <div class="content">
            <span class="material-icons">check_circle</span>
            <h1>Успешно!</h1>
            <div class="text">
                <p id="rest-p"></p>
                <p id="date-time-p"></p>
                <p id="table-p"></p>
                <p id="address-p"></p>
                <p id="code-p"></p>
            </div>
            <p id="" style="font-size: 16px; opacity: 50%;">Сделайте снимок экрана, чтобы сохранить код бронирования и
                QR-код</p>
            <button onclick="notification.style.display = 'none'">Закрыть</button>
        </div>
    </div>

    <div id="header_menu">
        <nav>
            <button onclick="header_menu.style.display = 'none'"><span class="material-icons">close</span></button>
            <a href="index.php"
                style="text-decoration: underline; font-weight: bold; transform: trnslateX(5px);">Бронирование</a>
            <a href="restaurants.php">Рестораны</a>
            <a href="contacts.php">Контакты</a>

        </nav>
    </div>

    <div class="notif-popup" id="popup">
        <div class="icon" id="icon_d"><span class="material-icons" id="icon"></span></div>
        <p id="popuptext"></p>
    </div>

    <script src="js/booking.js"></script>
</body>

</html>