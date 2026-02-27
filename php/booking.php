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

if ($type == "submit") {
    $time_id = (int)$data["time_id"];
    $fullname = $data["full_name"];
    
    $phone = $data["phone"];
    $sql = "SELECT * FROM free_places WHERE id = ?";
    
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param('i', $time_id);
    $stmt -> execute();
    $result = $stmt -> get_result();
    if ($result -> num_rows > 0){
        $row = $result -> fetch_assoc();
        $restaurant = $row["restaurant"];
        $address = $row["address"];
        $stmt -> close();
    } else{
        echo json_encode(["success" => false, "error" => "Дата и время не найдены!"]);
        $stmt -> close();
        exit;
    }
    $sql = "INSERT INTO booked_places(restaurant_id, date, time, phone, fullname, restaurant, code) VALUES (?,?,?,?,?,?,?)";
    $stmt = $conn -> prepare($sql);
    $code = codeGenerate($phone);
    $stmt -> bind_param('issssss', $row["restaurant_id"], $row["date"], $row["time"], $phone, $fullname, $restaurant, $code);
    $stmt -> execute();
    
    $stmt -> close();
    

    $sql = "DELETE FROM free_places WHERE id = ?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param('i', $time_id);
    $stmt -> execute();
    echo json_encode(["success" => true, "result" => ["rest" => $restaurant, "date-time" => $row["date"] . " " . $row["time"], "address" => $address, "code" => $code]]);
    exit;
}