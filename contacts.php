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

    <form id = "appeal-form" class="advise">
        <h3>Свяжитесь с нами!</h3>

        <div class="entry">
            <label for="">Получатель</label>
            <select name="" id="recipient" >
                <option value="1221815181" selected>AVRORA</option>
                <?php
                $sql = "SELECT id, name FROM restaurants";
                $stmt = $conn -> prepare($sql);
                $stmt -> execute();
                $result = $stmt -> get_result();
                while($row = $result -> fetch_assoc()):?>
                <option value=<?= $row["id"]?>><?= $row["name"]?></option>
                <?php endwhile;?>
            </select>
            <p>Администрация AVRORA в любом случае получит Ваше обращение</p>
        </div>

        <div class="entry">
            <label for="">Имя</label>
            <input type="text" id="name_adv" required>
        </div>

        <div class="entry">
            <label for="">Почта</label>
            <input type="text" id="email" required>
        </div>

        <div class="entry">
            <label for="">Сообщение</label>
            <textarea name="" id="advise" required></textarea>
            <p id="count">0/500</p>
        </div>
        

        <button type="submit" class="send">Отправить</button>
    </form>

    <div id="error-c" >
        <div style="display: flex">
            <span class="material-icons">error</span>
            <h1>Ошибка</h1>
        </div>
        <p id="error-c-p"></p>
        
    </div>


    <div id="notification" onclick="this.style.display = 'none'">
        <div class="content">
            <span class="material-icons">check_circle</span>
            <h1>Успешно!</h1>
            <div class="text">
                <p>Обращение отправлено!</p>
                <p>Его получит адресат, а также администрация сервиса!</p>
            </div>
            <p id="appeal-id" style="font-size: 16px; opacity: 50%;"></p>
            <button onclick="notification.style.display = 'none'">Закрыть</button>
        </div>
    </div>
    <script src="js/appeal.js"></script>
    <script>
        document.getElementById("advise").addEventListener("input", e => {
            txt = document.getElementById("advise").value
            l = txt.length
            let p = document.getElementById("count")
            p.innerText = l + "/500"
            if (l >= 500){
                p.style.color = "#ff0000"
                p.style.opacity = "100%"
            }else{
                p.style.color = ""
                p.style.opacity = ""
            }
            
        })
    </script>
</body>

</html>