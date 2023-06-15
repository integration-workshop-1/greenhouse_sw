<?php
include("db_connection.php");

if (isset($_POST['update_data_button']))
{

	$manual_data_plant_id = $_POST['manual_data_plant_id'];
	$manual_data_temperature = $_POST['manual_data_temperature'];
	$manual_data_soil_moisture = $_POST['manual_data_soil_moisture'];
	$manual_data_air_humidity = $_POST['manual_data_air_humidity'];


	$sql = "UPDATE manual_data_modify SET manual_data_plant_id = '$manual_data_plant_id', manual_data_temperature = '$manual_data_temperature', manual_data_soil_moisture = '$manual_data_soil_moisture',  manual_data_air_humidity = '$manual_data_air_humidity' WHERE manual_data_modify.manual_data_id = 1";

	if ($conn->query($sql) === TRUE)
	{
		echo "<script type = 'text/javascript'> 
	    		alert('Successfully data inserted!');
	    		javascript:window.location='manual_data.php';
	    	</script>";	 				
	}
	else
	{
		echo "<script type = 'text/javascript'> alert('Error to insert data!'); </script>";
		echo "Error: " . $conn->error;

	}	

}

$conn->close();
?>