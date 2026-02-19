<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="system/img/logo.svg">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>В Х О Д</title>
</head>

<body class="login-body">
    <button onclick="window.history.back()" class="back"><span class="material-icons">arrow_back</span></button>
    <form class="login-form" id="login_form">
        <div class="entry">
            <img src="system/img/logo.svg" alt="">
        </div>
        <div class="entry">
            <label for="">Логин</label>
            <input type="text" id="login">
        </div>
        <div class="entry">
            <label for="">Пароль</label>
            <input type="password" id="password">
        </div>
        <div class="entry">
            <button type="submit">Войти</button>
            <a href="">Подключить ресторан</a>
        </div>
        <p id="error"></p>

    </form>
    <script src="js/loging.js"></script>
</body>

</html>