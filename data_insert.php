<?php

include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
	
    $api_key_value="tPmAT5Ab3j7F9";

    //Recebeu a mesma chave passada
    if($api_key == $api_key_value) {


        $soil_moisture = test_input($_POST["soil_moisture"]);
        $air_humidity = test_input($_POST["air_humidity"]); 
        $air_temperature = test_input($_POST["air_temperature"]); 
        $is_dark = test_input($_POST["is_dark"]); 
        
        //Conexão com o banco
        $conn = new mysqli($servername, $username, $password, $dbname);

        //Verifica conexão
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        //Query de inserção no banco
        
        $sql = "INSERT INTO sensors_read(sensor_read_id, sensor_sensors_id, sensor_read, sensor_read_timestamp) 
        VALUES 
        (NULL, 1, '$soil_moisture', NULL),
        (NULL, 2, '$air_humidity', NULL),
        (NULL, 3, '$air_temperature', NULL),
        (NULL, 4, '$is_dark', NULL)
        ";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>