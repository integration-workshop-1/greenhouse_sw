<?php
include("db_connection.php");

if(isset($_POST['manual_data'])){
	$manual_data = $_POST['manual_data'];

	$sql = "UPDATE manual_data_modify SET manual_data_connection_type = '$manual_data' WHERE manual_data_modify.manual_data_id = 1";

	if ($conn->query($sql) === TRUE)
	{
		header ("location: index.php");		 				
	}
	else
	{
		header ("location: index.php");

	}	
}

if (isset($_POST['automatic_data'])){
	$automatic_data = $_POST['automatic_data'];
	$sql = "UPDATE manual_data_modify SET manual_data_connection_type = '$automatic_data' WHERE manual_data_modify.manual_data_id = 1";

	if ($conn->query($sql) === TRUE)
	{
		header ("location: index.php");				
	}
	else
	{
		header ("location: index.php");

	}	
}


$conn->close();
?>