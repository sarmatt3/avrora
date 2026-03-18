<?php
require_once("php/db.php");
require_once("php/funcs.php");

if (!isset($_COOKIE["auth"])) {
    $_SESSION['title'] = "Вход";
    $_SESSION["url"] = "login.php";
    header("Location: login.php");
} else {
    getData($_COOKIE["auth"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="system/img/logo-b.svg">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title><?= strtoupper($_SESSION["title"]) ?></title>
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
            <a href="contacts.php">Контакты</a>
        </nav>

        <nav class="login-btn" onclick="manage_panel.style.display = 'block'">
            <a href=<?= $_SESSION["url"] ?> onmouseenter="manage_panel.style.display = 'block'"
                onmouseleave="manage_panel.style.display = 'none'"
                style="text-decoration: underline; font-weight: bold;"><?= $_SESSION["title"] ?>
            </a>
        </nav>
    </header>

    <div class="main">
        <div class="profile">
            <img src=<?= "system/folders/" . $_SESSION["img"] ?> class="profile-img">
            <div class="info-profile">
                <h3><?= $_SESSION["title"] ?></h3>
                <p><?= $_SESSION["desc"] ?></p>
            </div>

            <button onclick="">Изменить</button>
        </div>
    </div>

    <div class="main">
        <div class="books">
            <h2>Брони</h2>
            <table>
                <tr>
                    <td>№</td>
                    <td>ФИО</td>
                    <td>Телефон</td>
                    <td>Дата</td>
                    <td>Время</td>
                    <td>Стол</td>
                    <td>Адрес</td>
                </tr>

                <?php
                $sql = "SELECT * FROM booked_places WHERE restaurant_id = ? ORDER BY id DESC";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $_SESSION["id"]);
                $stmt->execute();
                $n = 1;
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()):
                    $data = [
                        "phone" => $row['phone'],
                        "datetime" => $row["date"] . " - " . $row["time"],
                        "rest" => $row["restaurant"],
                        "address" => $row["address"]
                    ];

                    $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
                    ?>
                    <tr>
                        <td><?= $n ?></td>
                        <td><?= $row["fullname"] ?></td>
                        <td><?= $row["phone"] ?></td>
                        <td><?= $row["date"] ?></td>
                        <td><?= $row["time"] ?></td>
                        <td><?= $row["table_"] ?></td>
                        <td><?= $row["code"] ?></td>
                        <td><button value=<?= $row['id'] ?> id="del"
                                onclick="accept()">Удалить</button></td>
                        <td>
                            <form action="php/sendsms.php" method="post"><button name="notif" value='<?= $jsonData ?>'
                                    id="notif_btn">Напоминание</button></form>
                        </td>
                    </tr>

                    <?php $n += 1; endwhile ?>
            </table>
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


    <div id="manage_panel" onmouseenter="manage_panel.style.display = 'block'"
                onmouseleave="manage_panel.style.display = 'none'">
        <nav>
            <button onclick=""><span class="material-icons">logout</span> Выход</button>
        </nav>
    </div>

    <div class="warning" id="notification">
        <div class="content warning-bd">
            <span class="material-icons" style="color: var(--orange);">warning</span>
            <p class="war-txt">Вы действительно хотите удалить эту запись? Клиент будет оповещен об отмене брони!</p>
            <div class="btns">
                <button>Подтвердить</button>
                <button style="background-color: red;" onclick="notification.style.display = 'none'">Отмена</button>
            </div>

        </div>
    </div>

    <script>
        let modal = document.getElementById("notification")
        function accept(){
            
            modal.style.display = "block"
        }
    </script>
</body>

</html>