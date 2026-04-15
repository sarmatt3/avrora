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
    <main>
        <table>
            <tr class="header">
                <td>ID</td>
                <td>Ресторан</td>
                <td>Описание</td>
            </tr>
            <?php 
            $sql = "SELECT id, name, description FROM restaurants";
            $result = mysqli_query($conn, $sql);
            while ($row = $result -> fetch_assoc()):?>
            <tr >
                <td><?=$row["id"]?></td>
                <td><?=$row["name"]?></td>
                <td><?=$row["description"]?></td>
            </tr>
            <?php endwhile;?>
            </table>
</main>

<main>
        <table>
            <tr class="header">
                <td>ID</td>
                <td>ID получателя</td>
                <td>Имя</td>
                <td>Почта</td>
                <td>Сообщение</td>
            </tr>
            <?php 
            $sql = "SELECT * FROM appeals";
            $result = mysqli_query($conn, $sql);
            while ($row = $result -> fetch_assoc()):?>
            <tr >
                <td><?=$row["id"]?></td>
                <td><?=$row["recipient"]?></td>
                <td><?=$row["fullname"]?></td>
                <td><?=$row["email"]?></td>
                <td><?=$row["text"]?></td>
            </tr>
            <?php endwhile;?>
            </table>
</main>
</body>
</html>