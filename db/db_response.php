<?php
include ("db_connection.php");

$sql = "SELECT manual_data_connection_type FROM manual_data_modify WHERE manual_data_id = 1";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) 
{
    $data = mysqli_fetch_assoc($result);
    header('Content-Type: application/json');
    echo json_encode($data);
}
else 
{
    echo "Error accessing database";
}

// Close the database connection
mysqli_close($conn);
?>