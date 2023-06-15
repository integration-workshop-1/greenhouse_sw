<?php
include('db_connection.php');

$sql = "SELECT 	manual_data_temperature as air_temperature, manual_data_soil_moisture as soil_moisture FROM manual_data_modify WHERE manual_data_id = 1";

$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {

    $dados = mysqli_fetch_assoc($result);

     // Retornar os dados como uma resposta JSON - aqui eu recupero no esp 
    header('Content-Type: application/json');
    echo json_encode($dados);

} else {
    echo "Error accessing database";
}

mysqli_close($conn);
?>