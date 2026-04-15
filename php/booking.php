<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);
require_once("db.php");
require_once("funcs.php");


$type = $data["type"];

if ($type == "date"){
    $rest = $data["restaurant"];

    $sql = "SELECT * FROM free_places WHERE restaurant = ? GROUP BY date";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("s", $rest);
    $stmt -> execute();
    $result = $stmt -> get_result();
    if (!($result -> num_rows > 0)){
        echo json_encode(["success" => false, "error" => "Даты не найдены!"]);
        $stmt -> close();
        exit;
    }
    $dates = [];
    while ($row = $result -> fetch_assoc()){
        $dates[] = [
            "date" => $row["date"]
        ];
    }

    $stmt -> close();
    echo json_encode(["success" => true, "result" => $dates]);
    exit;
}



if ($type == "time"){
    $date = $data["date"];
    $rest = $data["restaurant"];

    $sql = "SELECT * FROM free_places WHERE date = ? and restaurant = ? GROUP BY time";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("ss", $date, $rest);
    $stmt -> execute();
    $result = $stmt -> get_result();
    if (!($result -> num_rows > 0)){
        echo json_encode(["success" => false, "error" => "Даты не найдены!"]);
        $stmt -> close();
        exit;
    }
    $times = [];
    while ($row = $result -> fetch_assoc()){
        $times[] = [
            "time" => $row["time"]
        ];
    }

    $stmt -> close();
    echo json_encode(["success" => true, "result" => $times]);
    exit;
}



if ($type == "table"){
    $time = $data["time"];
    $date = $data["date"];
    $rest = $data["restaurant"];
    $sql = "SELECT * FROM free_places WHERE time = ? and date = ? and restaurant = ? GROUP BY table_";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("sss", $time, $date, $rest);
    $stmt -> execute();
    $result = $stmt -> get_result();
    if (!($result -> num_rows > 0)){
        echo json_encode(["success" => false, "error" => "Даты не найдены!" . $date . $time]);
        $stmt -> close();
        exit;
    }
    $tables = [];
    while ($row = $result -> fetch_assoc()){
        $tables[] = [
            "table" => $row["table_"],
            "id" => $row["id"]
        ];
    }

    $stmt -> close();
    echo json_encode(["success" => true, "result" => $tables]);
    exit;
}


if ($type == "submit"){


    $time = $data["time"];
    $date = $data["date"];
    $rest = $data["restaurant"];
    
    $id = (int)$data["book_id"];
    $fullname = $data["fullname"];
    $phone = $data["phone"];

    $sql = "SELECT * FROM free_places WHERE id = ?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("i", $id);
    $stmt -> execute();
    $result = $stmt -> get_result();
    $row = $result -> fetch_assoc();
    $table = $row["table_"];
    $stmt -> close();


    $sql = "DELETE FROM free_places WHERE id = ?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("i", $id);
    $stmt -> execute();
    $stmt -> close();

    $sql = "SELECT id, address FROM restaurants WHERE name = ?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("s", $rest);
    $stmt -> execute();
    $result = $stmt -> get_result();
    $row = $result -> fetch_assoc();
    $rest_id = (int)$row["id"];
    $address = $row["address"];
    $stmt -> close();


    $sql = "INSERT INTO booked_places(restaurant, restaurant_id, date, time, table_, fullname, phone, code, address) VALUES (?,?,?,?,?,?,?,?,?)";
    $code = codeGenerate($phone);
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("sississss", $rest, $rest_id, $date, $time, $table, $fullname, $phone, $code, $address);
    $stmt -> execute();
    $stmt -> close();
    
    echo json_encode(["success" => true, "result" => ["rest" => $rest, "date-time" => $date . " " . $time, "table" => $table, "code" => $code, "address" => $address]]);
    exit;
};

if ($type == "unbooking"){
    $phone = $data["phone_u"];
    $code_u = $data["code_u"];

    $sql = "SELECT * FROM booked_places WHERE phone = ? and code = ?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("ss", $phone, $code_u);
    $stmt -> execute();
    $result = $stmt -> get_result();
    $row = $result -> fetch_assoc();
    
    $stmt -> close();
    if ($result -> num_rows == 0){
        echo json_encode(["success" => false, "error" => "Бронь не найдена!"]);
        exit;
    }


    $sql = "DELETE FROM booked_places WHERE phone = ? and code = ?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("ss", $phone, $code_u);
    $stmt -> execute();
    $stmt -> close();

    


    $sql = "INSERT INTO free_places(restaurant, restaurant_id, date, time, table_, address) VALUES (?,?,?,?,?,?)";
    $code = codeGenerate($phone);
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("sissss", $row["restaurant"], $row["restaurant_id"], $row["date"], $row["time"], $row["table_"], $row["address"]);
    $stmt -> execute();
    $stmt -> close();

    echo json_encode(["success" => true]);

}