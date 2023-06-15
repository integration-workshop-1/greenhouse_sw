<?php
// Configurações de conexão com o banco de dados
$servername = "localhost";
$username = "ESP32";
$password = "esp32io.com";
$dbname = "greenhouse_project";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
     die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    //header("Location: 404.html");
   
}
?>