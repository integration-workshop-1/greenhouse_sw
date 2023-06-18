<?php
$servername = "localhost";
$username = "ESP32";
$password = "esp32io.com";
$dbname = "greenhouse_project";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

?>