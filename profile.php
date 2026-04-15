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

            <button onclick="openEditor(<?= $_SESSION['id'] ?>)" value=<?= $_SESSION["id"] ?>>Изменить</button>
            <button id="tg-log">Вход в телеграм</button>
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
                        "address" => $row["address"],
                        "id" => (int)$row["id"]
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
                        <td><button value=<?= $row['id'] ?> id="del" onclick="accept()">Удалить</button></td>
                        <td>
                            <form action="php/sendsms.php" method="post"><button name="notif" value='<?= $jsonData ?>'
                                    id="notif_btn">Напоминание</button></form>
                        </td>
                    </tr>

                    <?php $stmt -> close(); $n += 1; endwhile ?>
            </table>
        </div>


        <div class="books">
            <h2>Обратная связь</h2>
            <table>
                <tr>
                    <td>№</td>
                    <td>ФИО</td>
                    <td>Телефон</td>
                    <td>Дата</td>
                    
                </tr>

                <?php
                $sql = "SELECT * FROM appeals WHERE recipient = ? ORDER BY id DESC";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $_SESSION["id"]);
                $stmt->execute();
                
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?= $row["id"] ?></td>
                        <td><?= $row["fullname"] ?></td>
                        <td><?= $row["email"] ?></td>
                        <td><?= $row["date"] ?></td>
                        <td><button value="<?= $row["text"] ?>" onclick="openAppeal({'name' : '<?= $row['fullname'] ?>', 'text' : '<?= $row['text'] ?>', 'email' : '<?= $row['email'] ?>'})">Открыть</button></td>
                        
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
                <form action="php/sendsms.php" method="post"><button id="accept" name="del">Подтвердить</button></form>
                <button style="background-color: red;" onclick="notification.style.display = 'none'">Отмена</button>
            </div>

        </div>
    </div>

    <div class="editor" id="editor" onclick="">
        <div class="e-content">
            <div style="display: flex">
            <form method="post" enctype="multipart/form-data" style="max-width: 50%">
                <img src=<?= "system/folders/" . $_SESSION["img"] ?> class="profile-img">
                <input type="file" name="" id="">
            </form>
            <div class="info-profile">
                <input type="text" value=<?= $_SESSION["title"] ?>
                    style="border-bottom: 2px solid var(--base); font-weight: bold;">
                <textarea name="" id="" rows="19"><?= $_SESSION["desc"] ?></textarea>
            </div>
            </div>
            <button type="submit">Сохранить</button>
        </div>
        
    </div>

    <div id="appeal">
        <div class="a-content" id="a-content">
            <p id="a-text"></p>

        </div>
    </div>
    
    <script>
        let modal = document.getElementById("notification")
        function accept() {
            let dl = document.getElementById("del").value
            let ac = document.getElementById("accept")
            ac.value = dl
            modal.style.display = "block"
        }

        function openEditor(id) {
            ed = document.getElementById("editor")
            ed.style.display = "block"
        }

        function openAppeal(val){
            ap = document.getElementById("appeal")
            ap.style.display = "block"
            p = document.createElement("p")
            h = document.createElement("h1")
            b = document.createElement("button")
            p.innerText = val["text"]
            h.innerText = val["name"]
            b.innerText = "Ответить"
            
        
            document.getElementById("a-content").appendChild(h)
            document.getElementById("a-content").appendChild(p)
            document.getElementById("a-content").appendChild(b)


        }
    </script>
    <script src="js/tg-log.js"></script>
</body>

</html>