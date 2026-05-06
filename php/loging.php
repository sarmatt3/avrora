<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);
require_once("db.php");
require_once("funcs.php");

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

$sql = "SELECT * FROM restaurants WHERE login = ?";
$stmt = $conn -> prepare($sql);
$stmt -> bind_param("s", $login);
$stmt -> execute();
$result = $stmt -> get_result();

if($result -> num_rows == 0){
    echo json_encode(["success" => false, "error" => "Логин не найден!"]);
    exit;
}

$row = $result -> fetch_assoc();

if(!password_verify($pass, $row["password"])){
    echo json_encode(["success" => false, "error" => "Неверный пароль!"]);
    exit;
}

if($row["status"] != "active"){
    echo json_encode(["success" => false, "error" => "Учетная запись неактивна! Обратитесь в поддержку AVRORA для установления причин"]);
    exit;
}

echo json_encode(["success" => true]);
setcookie("auth", $row["session_token"], time() + (86400 * 3), "/");
getData($row["session_token"]);
exit;