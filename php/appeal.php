<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);
require "db.php";
require "funcs.php";

$id = $data["id"];
$fullname = $data["fullname"];
$text = htmlspecialchars($data["text"]);
$email = $data["email"];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo json_encode(["success" => false, "error" => "Неккоректный адрес электронной почты"]);
    exit;
}

if (mb_strlen($text) >= 500){
    echo json_encode(["success" => false, "error" => "Слишком длинное сообщение. Уместитесь в 500 символов"]);
    exit;
}
$date = date("Y-m-d");
$sql = "INSERT INTO appeals(recipient, fullname, email, text, date) VALUES (?,?,?,?,?)";
$stmt = $conn -> prepare($sql);
$stmt -> bind_param('issss', $id, $fullname, $email, $text, $date);
$stmt -> execute();
$stmt -> close();

$sql = "SELECT id FROM appeals WHERE recipient = ? AND fullname = ? AND email = ? AND text = ? AND date = ?";
$stmt = $conn -> prepare($sql);
$stmt -> bind_param('issss', $id, $fullname, $email, $text, $date);
$stmt -> execute();
$result = (($stmt -> get_result()) -> fetch_assoc())["id"];
$stmt -> close();

echo json_encode(["success" => true, "id" => $result]);
exit;