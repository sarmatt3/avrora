<?php
require_once("php/db.php");
require_once("php/funcs.php");

$sql = "SELECT name, description, img, site FROM restaurants";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="system/img/logo.svg">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R E S T A U R A N T S</title>
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
            <a href="restaurants.php" style="text-decoration: underline">Рестораны</a>
            <a href="contacts.php">Контакты</a>
        </nav>

        <nav class="login-btn">
            <a href=<?= $_SESSION["url"] ?>><?= $_SESSION["title"] ?></a>
        </nav>
    </header>


    <div class="rests">
        <?php
        while ($rest = $result->fetch_assoc()): ?>
            <div class="rest">
                <img src=<?= "system/folders/" . $rest["img"] ?> alt="">
                <h1 style="letter-spacing: 2px;"><?= $rest["name"] ?></h1>
                <p><?= $rest["description"] ?></p>
                <a href=<?=$rest['site']?> class="a-btn" target="_blank">Перейти на сайт</a>
            </div>
        <?php endwhile ?>

    </div>

    <div id="header_menu">
        <nav>
            <button onclick="header_menu.style.display = 'none'"><span class="material-icons">close</span></button>
            <a href="index.php">Бронирование</a>
            <a href="restaurants.php" style="text-decoration: underline">Рестораны</a>
            <a href="contacts.php">Контакты</a>
            
        </nav>
    </div>


</body>

</html>