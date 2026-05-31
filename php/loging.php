<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);
require_once("db.php");
require_once("funcs.php");

$login = $data["login"];
$pass = $data["pass"];

if (empty($login) || empty($pass)) {
    echo json_encode(["success" => false, "error" => "Заполните все поля!"]);
    exit;
}

// Определяем роль по префиксу
if (substr($login, 0, 6) == "01ADM-") {
    $role = "admin";
    $sql = "SELECT * FROM admins WHERE login = ?";
} elseif (substr($login, 0, 6) == "01AVR-") {
    $role = "avr";
    $sql = "SELECT * FROM restaurants WHERE login = ?";
} else {
    echo json_encode(["success" => false, "error" => "Некорректный формат логина"]);
    exit;
}

// Выполняем запрос
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $login);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo json_encode(["success" => false, "error" => "Логин не найден!"]);
    exit;
}

$row = $result->fetch_assoc();

// Проверяем пароль
if (!password_verify($pass, $row["password"])) {
    echo json_encode(["success" => false, "error" => "Неверный пароль!"]);
    exit;
}

if (isset($row["status"]) && $row["status"] != "active"){
    echo json_encode(["success" => false, "error" => "Ваша учетная запись заблокирована!"]);
    exit;
}

// Устанавливаем куку
setcookie("auth", $row["session_token"], time() + (86400 * 3), "/");
$u_role = password_hash($login, PASSWORD_DEFAULT);
setcookie("verify", $u_role, time() + (86400 * 3), "/");

// Возвращаем успех и роль
echo json_encode(["success" => true, "role" => $role]);
exit;
?>