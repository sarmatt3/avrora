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

if ($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST["disable"]) || isset($_POST["activate"]))) {
    
    if (isset($_POST["disable"])) {
        $id = (int) $_POST["disable"];
        $sql = "UPDATE restaurants SET status = 'disabled' WHERE id = '$id'";
    } else {
        $id = (int) $_POST["activate"];
       $sql = "UPDATE restaurants SET status = 'active' WHERE id = '$id'";
    }

    mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/admin.css">
    
    <title>Администрирование и управление сервисом</title>
</head>

<body>
    <main>
        <h1><?=$_SESSION["title"]?></h1>
        <p><?="Логин: " . $_SESSION["lgn"]?></p>
        <h3><?="Уровень доступа: " . $_SESSION["privilege"]?></h3>
        <button onclick="logout()"><span class="material-icons">logout</span> Выход</button>
    </main>
    <main class="col-2">
        <h1>Рестораны</h1>
        <table>

            <tr class="header">
                <td>ID</td>
                <td>Название</td>
                <td>Кол-во обращений</td>
                <td>Статус</td>
                <td></td>
            </tr>
            <?php
            $sql = "SELECT id, name, status, mail FROM restaurants";
            $result = mysqli_query($conn, $sql);
            while ($rest = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $rest["id"] ?></td>
                    <td><?= $rest["name"] ?></td>
                    <td><?= $rest["name"] ?></td>
                    <td><?= $rest["status"] ?></td>
                    <td>
                        <form class="buttons" action="" method="post">
                            <?php if ($rest["status"] == "disabled"): ?>
                                <button type="submit" value="<?= $rest['id'] ?>" name="activate" class="activate">Разблокировать</button>
                            <?php else: ?>
                                <button type="submit" value="<?= $rest['id'] ?>" name="disable" class="disable">Отключить</button>
                            <?php endif ?>
                            <a href="mailto:<?=$rest['mail']?>?subject=Служебное письмо от администрации сервиса AVRORA" class="send_mail">Отправить письмо</a>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
            <h1>Обращения</h1>
        <table>
            <tr class="header">
                <td>ID</td>
                <td>ФИО</td>
                <td>Текст</td>
                <td>Получатель</td>
                <td>Дата</td>
            </tr>
            <?php
            $sql = "SELECT * FROM appeals";
            $result = mysqli_query($conn, $sql);
            while ($rest = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $rest["id"] ?></td>
                    <td><?= $rest["fullname"] ?></td>
                    <td><?= $rest["text"] ?></td>
                    <td><?= $rest["recipient"] ?></td>
                    <td><?= $rest["date"] ?></td>
                    <td>
                        <div class="buttons">
                            <button class="reply" onclick="reply('<?=$rest['email']?>', '<?=$rest['fullname']?>', '<?=$rest['text']?>', '<?=$rest['id']?>')">Ответить</button>

                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </main>

    <main>
        <h1>Свободные места</h1>
        <select name="restaurant" id="restaurant">
            <?php
            $sql = "SELECT id, name FROM restaurants";
            $result = mysqli_query($conn, $sql);
            while ($rest = $result->fetch_assoc()):
                ?>
                <option value="<?=$rest['id']?>"><?=$rest['name']?></option>
                <?php endwhile; ?>
        </select>
        <table>
            <tr class="header">
                <td>Ресторан</td>
                <td>Дата и время</td>
                <td>Адрес</td>
                <td>Стол</td>
                
            </tr>
            <?php
            $sql = "SELECT * FROM free_places";
            $result = mysqli_query($conn, $sql);
            while ($rest = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $rest["restaurant"] ?></td>
                    <td><?= $rest["date"] . " " . $rest["time"] ?></td>
                    <td><?= $rest["address"] ?></td>
                    <td><?= $rest["table_"] ?></td>
                    
                </tr>
            <?php endwhile; ?>
        </table>
    </main>

    <main>
        <h1>Занятые места</h1>
        <select name="restaurant" id="restaurant">
            <?php
            $sql = "SELECT id, name FROM restaurants";
            $result = mysqli_query($conn, $sql);
            while ($rest = $result->fetch_assoc()):
                ?>
                <option value="<?=$rest['id']?>"><?=$rest['name']?></option>
                <?php endwhile; ?>
        </select>
        <table>
            <tr class="header">
                <td>Ресторан</td>
                <td>Дата и время</td>
                <td>Адрес</td>
                <td>Стол</td>
                <td>Код</td>
                
            </tr>
            <?php
            $sql = "SELECT * FROM booked_places";
            $result = mysqli_query($conn, $sql);
            while ($rest = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $rest["restaurant"] ?></td>
                    <td><?= $rest["date"] . " " . $rest["time"] ?></td>
                    <td><?= $rest["address"] ?></td>
                    <td><?= $rest["table_"] ?></td>
                    <td><?= $rest["code"] ?></td>
                    <td><button class="red" onclick="accept()" id="del" value="<?=$rest["id"]?>">Отменить</button></td>
                    
                </tr>
            <?php endwhile; ?>
        </table>
    </main>


    <main>
        <h1>Администраторы</h1>
        
        <table>
            <tr class="header">
                <td>ID</td>
                <td>ФИО</td>
                <td>Логин</td>
                <td></td>
                
                
            </tr>
            <?php
            $sql = "SELECT * FROM admins";
            $result = mysqli_query($conn, $sql);
            while ($adm = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $adm["id"] ?></td>
                    <td><?= $adm["fullname"] ?></td>
                    <td><?= $adm["login"] ?></td>
                    <td><button name="delete_adm" value="<?=$adm['id']?>" class="red">Удалить</button></td>
                    
                    
                </tr>
            <?php endwhile; ?>
        </table>
        <button onclick="window.location.href='add-admin.php'"><span class="material-icons">add</span></button>
    </main>


    <button onclick="window.location.href = 'php/add-rest.php'">Подключить новый ресторан</button>
    

    <div id="dialog_reply">
        <div class="content">
            <h2 id="client-name"></h2>
            <p id="appeal"></p>
            <div style="display: flex; justify-content: space-between; width: 100%;">
                <a id="mailbtn" class="send_mail">Отправить письмо</a>
            <button onclick="dialog_reply.style.display = 'none'">Отмена</button>
            </div>
            
        </div>
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


    <div class="notif-popup" id="popup">
        <div class="icon" id="icon_d"><span class="material-icons" id="icon"></span></div>
        <p id="popuptext"></p>
    </div>

    <script src="js/admining.js"></script>
<script>
    let modal = document.getElementById("notification")
        function accept() {
            let dl = document.getElementById("del").value
            let ac = document.getElementById("accept")
            ac.value = dl
            modal.style.display = "block"
        }

        function logout(){
            let conf = confirm("Вы действительно хотите выйти из системы?")
            if (conf){
            document.cookie = "auth=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
            location.reload()} else{}

        }

    function reply(email, name, text, id){
        const dialog = document.getElementById("dialog_reply")
        const name_h = document.getElementById("client-name")
        const text_p = document.getElementById("appeal")
        const mail = document.getElementById("mailbtn")

        dialog.style.display = "flex"
        name_h.innerText = name
        text_p.innerText = text
        mail.href = "mailto:" + email + "?subject=Ответ на обращение №" + id + " от AVRORA"

    }

    
</script>
</body>

</html>