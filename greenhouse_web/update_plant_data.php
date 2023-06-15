<?php
include("db_connection.php");

if (isset($_POST['plant_update_button']))
{
	$plant_id = $_POST['plant_id'];
	$plant_name = $_POST['plant_name'];
	$plant_temperature = $_POST['plant_temperature'];
	$plant_soil_moisture = $_POST['plant_soil_moisture'];
	$plant_air_humidity = $_POST['plant_air_humidity'];
	$plant_description = $_POST['plant_description'];

	$sql = "UPDATE plants SET plant_name = '$plant_name', plant_temperature = '$plant_temperature',
	plant_soil_moisture = '$plant_soil_moisture', plant_air_humidity = '$plant_air_humidity',
	plant_description = '$plant_description' WHERE plant_id = '$plant_id'";
	
	if ($conn->query($sql) === TRUE)
	{
		echo "<script type = 'text/javascript'> 
	    		alert('Successfully data updeted!');
	    		javascript:window.location='plants_update.php';
	    	</script>";	 

	}
	else
	{
  		echo "Error updating record: " . $conn->error;
	}

	


}

$conn->close();
?>