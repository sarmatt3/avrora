<?php
require_once("db.php");
require_once("funcs.php");

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["name"]) && isset($_POST["desc"]) && isset($_POST["site"])&& isset($_POST["mail"])&& isset($_POST["address"])){
    $name = $_POST["name"];
    $desc = $_POST["desc"];
    $mail = $_POST["mail"];
    $site = $_POST["site"];
    $address = $_POST["address"];

    

    // $login = loginGenerate($name, "rest");

    $sql = "INSERT INTO restaurants(name, description, mail, site, address) VALUES(?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $desc, $mail, $site, $address);
    $stmt->execute();
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подключение ресторана</title>
</head>
<body>
    <button onclick="window.history.go(-1)"><span class="material-icons">back</span></button>
    <form action="" method="post">
        <div class="entry">
            <label for="name">Название ресторана</label>
            <input type="text" id="name" name="name">
        </div>

        <div class="entry">
            <label for="desc">Описание</label>
            <textarea name="desc" id="desc"></textarea>
        </div>

        <div class="entry">
            <label for="mail">Эл. почта</label>
            <input type="text" id="mail" name="mail">
        </div>

        <div class="entry">
            <label for="site">URL сайта</label>
            <input type="text" id="site" name="site" value="https://">
        </div>

        <div class="entry">
            <label for="address">Адрес</label>
            <input type="text" id="adress" name="address">
        </div>

        <div class="entry">
            <button type="submit">Подключить</button>
        </div>
    </form>
</body>
</html>