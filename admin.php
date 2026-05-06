<?php
require "php/db.php";
require "php/funcs.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Администрирование и управление сервисом</title>
</head>
<body>
    <main class="rests">
        <table>
            <tr class="header">
                <td>ID</td>
                <td>Название</td>
                <td>Кол-во обращений</td>
                <td>Статус</td>
            </tr>
            <?php 
            $sql = "SELECT id, name, status FROM restaurants";
            $result = mysqli_query($conn, $sql);
            while ($rest = $result -> fetch_assoc()):
            ?>
            <tr>
                <td><?=$rest["id"]?></td>
                <td><?=$rest["name"]?></td>
                <td><?=$rest["name"]?></td>
                <td><?=$rest["status"]?></td>
                <td>
                    <div class="buttons">
                        <button>Отключить</button>
                        <button>Отправить письмо</button>
                    </div>
                </td>
            </tr>
            <?php endwhile;?>
        </table>
    </main>

    <main class="appeals">
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
            while ($rest = $result -> fetch_assoc()):
            ?>
            <tr>
                <td><?=$rest["id"]?></td>
                <td><?=$rest["fullname"]?></td>
                <td><?=$rest["text"]?></td>
                <td><?=$rest["recipient"]?></td>
                <td><?=$rest["date"]?></td>
                <td>
                    <div class="buttons">
                        <button>Ответить</button>
                        
                    </div>
                </td>
            </tr>
            <?php endwhile;?>
        </table>
    </main>
</body>
</html>