<?php
include('db_connection.php');

//Retorna os valores do banco para os quais o código escolhido é referente a planta
$sql = "SELECT plants.plant_temperature as air_temperature, plants.plant_soil_moisture as soil_moisture FROM plants INNER JOIN manual_data_modify ON plant_id = manual_data_plant_id";

$result = mysqli_query($conn, $sql);

if ($result) {
    //Retorna uma matriz associativa representando a próxima linha no conjunto de resultados
    $dados = mysqli_fetch_assoc($result);
    
     // Retornar os dados como uma resposta JSON - aqui eu recupero no esp
    header('Content-Type: application/json');
    echo json_encode($dados);

} else {
    echo "Error accessing database";
}

mysqli_close($conn);
?>