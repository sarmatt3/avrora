<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

$login = $data["login"];
$pass = $data["pass"];
if (empty($login) || empty($pass)){
    echo json_encode(["success" => false, "error" => "Заполните все поля!"]);
    exit;
}

if (substr($login, 0, 6) != "01AVR-"){
    echo json_encode(["success" => false, "error" => "Некорректный формат логина"]);
    exit;
}