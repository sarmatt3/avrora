<?php
require "funcs.php";
require "db.php";
$id = (int)$_POST["del"];
    $sql = "DELETE FROM booked_places WHERE id = ?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("i", $id);
    $stmt -> execute();
    $result = $stmt -> get_result();
    $stmt -> close();
   print_r($_POST);