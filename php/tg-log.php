<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);
require_once("db.php");
require_once("funcs.php");
$status = $data["status"];

if ($status == false){
    echo json_encode(["success" => false, "error" => "Непредвиденная ошибка"]);
    exit;
}

$code = generateAuthCode();
// $sql = "INSERT INTO auth (auth_token, code) VALUES (?,?)";
// $stmt = $conn -> prepare($sql);
// $stmt -> bind_param("si", $_COOKIE["auth"], $code);
// $stmt -> execute();
// $stmt -> close();
echo json_encode(["success" => true, "code" => $code]);
exit;