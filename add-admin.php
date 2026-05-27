<?php
require "php/db.php";
require "php/funcs.php";
if (!isset($_COOKIE["auth"])) {
    $_SESSION['title'] = "Вход";
    $_SESSION["url"] = "login.php";
    header("Location: login.php");
} else {
    getData($_COOKIE["auth"]);
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["login"]) && isset($_POST["fio"]) && isset($_POST["password"]) && isset($_POST["r_password"]) && isset($_POST["adm_pass"]) && isset($_POST["prev"])) {

    $fio = $_POST["fio"];
    $login = strtoupper($_POST["login"]);
    $pass = $_POST["password"];
    $rpass = $_POST["r_password"];
    $apass = $_POST["adm_pass"];
    $prev = $_POST["prev"];

    if ($_SESSION["privilege"] > 5) {
        if ($pass !== $rpass) {
            exit;
        }
        $aid = $_SESSION['id'];
        $sql = "SELECT password FROM admins WHERE id = '$aid'";
        $result = mysqli_query($conn, $sql);
        $passdb = ($result->fetch_assoc())["password"];
        if (!password_verify($apass, $passdb)) {
            exit;
        }

        $sql = "INSERT INTO admins(fullname, login, password, session_token, privilege) VALUES(?,?,?,?,?)";

        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $token = random_bytes(64);
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $fio, $login, $pass, $token ,$prev);
        $stmt->execute();

        header("Location: admin.php");
        

    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="system/img/logo.svg">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <form class="login-form" id="login_form" method="post" action="">
        <div class="entry">
            <label for="">ФИО</label>
            <input type="text" name="fio">
        </div>
        <div class="entry">
            <label for="">Логин</label>
            <input type="text" name="login">
        </div>
        <div class="entry">
            <label for="">Уровень доступа</label>
            <input type="" name="prev">
        </div>
        <div class="entry">
            <label for="">Пароль</label>
            <input type="password" name="password">
        </div>
        
        <div class="entry">
            <label for="">Подтвердите пароль</label>
            <input type="password" name="r_password">
        </div>

        <div class="entry">
            <label for="">Пароль администратора <?= $_SESSION["lgn"] ?></label>
            <input type="password" name="adm_pass">
        </div>
        <div class="entry">
            <button type="submit">Добавить</button>
        </div>
        <p id="error"></p>

    </form>
</body>

</html>