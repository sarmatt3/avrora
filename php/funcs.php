<?php
require_once('db.php');
session_start();
function getData($token){
    global $conn;
    $sql = "SELECT * FROM restaurants WHERE session_token = ?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("s", $token);
    $stmt -> execute();
    $result = $stmt -> get_result();
    $row = $result -> fetch_assoc();
    $_SESSION["title"] = $row["name"];
    $_SESSION["url"] = "profile.php";
    $stmt -> close();
}

function codeGenerate($phone){
    $number = rand(10000, 99999);
    $phone_ch = substr($phone, -4, 4);

    return "BKD-AVR-" . $number . $phone_ch;

}