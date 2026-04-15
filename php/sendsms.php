<?php
require "funcs.php";
require "db.php";
if (isset($_POST['notif'])) {
    $data = json_decode($_POST['notif'], true);
    sendSMS($data);

} else if (isset($_POST['del'])) {
    $id = (int) $_POST["del"];

    $sql = "SELECT * FROM booked_places WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    $data = [
        "phone" => $row['phone'],
        "datetime" => $row["date"] . " - " . $row["time"],
        "rest" => $row["restaurant"],
        "address" => $row["address"],
        "id" => (int) $row["id"]
    ];

    $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);

    $sql = "DELETE FROM booked_places WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    sendSMS($data, $msg = 'Ваша бронь в ресторане: \n' . $data["rest"] . ' по адресу:\n'. $data['address'] . '\nНа ' . $data['datetime'] . '\n Отменена сотрудником.\nДля уточнения информации свяжитесь с нами по номеру:\n77-95-77');
    echo $result . $id;


}

header("Location: ../profile.php");

