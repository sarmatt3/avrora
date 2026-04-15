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
    $_SESSION["img"] = $row["img"];
    $_SESSION["desc"] = $row["description"];
    $_SESSION["url"] = "profile.php";
    $_SESSION["id"] = (int)$row["id"];

    $stmt -> close();
}

function codeGenerate($phone){
    $number = rand(10000, 99999);
    $phone_ch = substr($phone, -4, 4);

    return "BKD-AVR-" . $number . $phone_ch;

}

function generateAuthCode(){
    return rand(100000, 999999);
}

function sendSMS($data, $msg = ""){
// Получаем данные из POST


    if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
        $phone = mb_substr($data['phone'], 1);
        $datetime = $data['datetime'];
        $rest = $data['rest'];
        $address = $data['address'];
        
        
        $api = "F5BCA790-6F46-942D-4999-230BBCAF9E11";
        if ($msg == ""){
        $msg = "Напоминаем, что у Вас забронирован стол в ресторане " . $rest . " по адрессу: " . $address . "\nНа " . $datetime;
        }
        
        $params = [
            "api_id" => $api,
            "to" => $phone,
            "msg" => $msg,
            "json" => 1

        ];

        $url = "https://sms.ru/sms/send";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

        $response = curl_exec($ch);
        curl_close($ch);
        
        
    } else {
        echo "Ошибка: Неверный формат данных";
        echo "<br>JSON ошибка: " . json_last_error_msg();
    }
} 
