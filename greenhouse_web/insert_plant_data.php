<?php
include("db_connection.php");

if (isset($_POST['plant_insert_button']))
{
	if( isset($_POST['plant_name']) || !empty($_POST['plant_name']) || !is_null($_POST['plant_name'])){
		$plant_name = $_POST['plant_name'];
		$plant_temperature = $_POST['plant_temperature'];
		$plant_soil_moisture = $_POST['plant_soil_moisture'];
		$plant_air_humidity = $_POST['plant_air_humidity'];
		$plant_description = $_POST['plant_description'];

		$sql = "INSERT INTO plants (plant_id, plant_name, plant_description, plant_temperature, plant_soil_moisture, plant_air_humidity) VALUES (NULL, '$plant_name', '$plant_description', '$plant_temperature', '$plant_soil_moisture', '$plant_air_humidity')";
	
		if ($conn->query($sql) === TRUE)
		{
  		echo "<script type = 'text/javascript'> 
	    		alert('Successfully data inserted!');
	    		javascript:window.location='insert_plant.php';
	    	</script>";	
		}
		else
		{
  		echo "Error insert data: " . $conn->error;
		}
	}
	else{
		header("location: insert_plant.php");
	}
	

	


}

$conn->close();
?>