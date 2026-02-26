<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);
require_once("db.php");
require_once("funcs.php");


$type = $data["type"];


if ($type == "date") {
    $id = (int) $data["rest"];

    if (empty($id)) {
        echo json_encode(["success" => false, "error" => "Заполните все поля!"]);
        exit;
    }

    $sql = "SELECT id, date FROM free_places WHERE restaurant_id = ? GROUP BY date";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $places = [];
    while ($row = $result->fetch_assoc()) {
        $places[] = [
            'id' => $row['id'],
            'date' => $row['date'],

        ];
    }
    $stmt->close();

    echo json_encode(["success" => true, "result" => $places]);
    exit;
}

if ($type == "time") {
    $id = $data["date"];
    $sql = "SELECT id, time FROM free_places WHERE date = ? GROUP BY time";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $places = [];
    while ($row = $result->fetch_assoc()) {
        $places[] = [
            'id' => $row["id"],
            'time' => $row['time'],

        ];
    }
    $stmt->close();

    echo json_encode(["success" => true, "result" => $places]);
    exit;
}