<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);
require "db.php";
require "funcs.php";

$type = $data["type"];
if ($type == "add_adm") {


    $fio = $data["fio"];
    $login = strtoupper($data["login"]);
    $pass = $data["password"];
    $rpass = $data["r_password"];
    $apass = $data["adm_pass"];
    $prev = $data["prev"];



    if ($_SESSION["privilege"] <= 5) {
        echo json_encode(["success" => false, "error" => "Слишком маленький уровень доступа!"]);
        exit;
    }
    if ($pass !== $rpass) {
        echo json_encode(["success" => false, "error" => "Пароли не совпадают!"]);
        exit;
    }

    $aid = $_SESSION['id'];
    $sql = "SELECT password FROM admins WHERE id = '$aid'";
    $result = mysqli_query($conn, $sql);
    $passdb = ($result->fetch_assoc())["password"];
    if (!password_verify($apass, $passdb)) {
        echo json_encode(["success" => false, "error" => "Неверный пароль для: " . $_SESSION["lgn"]]);
        exit;
    }

    $sql = "INSERT INTO admins(fullname, login, password, session_token, privilege) VALUES(?,?,?,?,?)";

    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $token = random_bytes(64);
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $fio, $login, $pass, $token, $prev);
    $stmt->execute();
    echo json_encode(["success" => true, "mes" => "Администратор успешно добавлен"]);
    exit;
} else
    if ($type == "delete_adm") {
        $id = $data["id"];
        $sql = "SELECT * FROM admins WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        $adm = $result -> fetch_assoc();

        if ($_SESSION["privilege"] <= 5) {
            echo json_encode(["success" => false, "error" => "Слишком маленький уровень доступа!"]);
            exit;
        }

        if ($adm["privilege"] > 15){
            echo json_encode(["success" => false, "error" => "Невозможно удалить супер-админа!"]);
            exit;
        }

        if($_SESSION["privilege"] <= $adm["privilege"] && $_SESSION["id"] != $id){
            echo json_encode(["success" => false, "error" => "Слишком маленький уровень доступа!"]);
            exit;}

        
        if ($_SESSION["id"] == $id){
            echo json_encode(["success" => false, "error" => "Невозможно удалить свою учетную запись!"]);
            exit;
        }

        $sql = "DELETE FROM admins WHERE id = '$id'";
        mysqli_query($conn, $sql);
        echo json_encode(["success" => true, "mes" => "Администратор успешно удален!"]);
        exit;




    }

?>