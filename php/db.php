<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "avrora";
$conn = mysqli_connect($host, $user, $pass, $db);
$conn -> set_charset("utf8mb4");
if ($conn -> connect_error){
    die ("Error DB" . $conn -> connect_error);

}