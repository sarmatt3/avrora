<?php
// Получаем данные из POST
if (isset($_POST['notif'])) {
    
    $data = json_decode($_POST['notif'], true);

    if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
        $phone = mb_substr($data['phone'], 1);
        $datetime = $data['datetime'];
        $rest = $data['rest'];
        $address = $data['address'];
        
        $api = "F5BCA790-6F46-942D-4999-230BBCAF9E11";
        $msg = "Напоминаем, что у Вас забронирован стол в ресторане " . $rest . " по адрессу: " . $address . "\nНа " . $datetime;
        
        
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
} else {
    echo "Нет данных для обработки";
}
?>