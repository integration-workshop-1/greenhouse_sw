<?php
include("db_connection.php");

$sql1 = "SELECT (100-(sensor_read/40.95)) as sensor_read ,TIME_FORMAT(sensor_read_timestamp, '%T')  AS read_timestamp FROM sensors_read WHERE sensor_sensors_id = 1 ORDER BY sensor_read_id DESC LIMIT 20";


$result1 = $conn->query($sql1);
$data1 = array();
if ($result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        $data1[] = $row;
    }
} 

$sql2 = "SELECT sensor_read,TIME_FORMAT(sensor_read_timestamp, '%T')  AS read_timestamp FROM sensors_read WHERE sensor_sensors_id = 3 ORDER BY sensor_read_id DESC LIMIT 20";


$result2 = $conn->query($sql2);
$data2 = array();

if ($result2->num_rows > 0) {
   
    while ($row = $result2->fetch_assoc()) {
        $data2[] = $row;
    }
} 

$sql3 = "SELECT sensor_read,TIME_FORMAT(sensor_read_timestamp, '%T')  AS read_timestamp FROM sensors_read WHERE sensor_sensors_id = 2 ORDER BY sensor_read_id DESC LIMIT 20";


$result3 = $conn->query($sql3);
$data3 = array();

if ($result3->num_rows > 0) {
   
    while ($row = $result3->fetch_assoc()) {
        $data3[] = $row;
    }
} 

$sql4 = "SELECT sensor_read,TIME_FORMAT(sensor_read_timestamp, '%T')  AS read_timestamp FROM sensors_read WHERE sensor_sensors_id = 4 ORDER BY sensor_read_id DESC LIMIT 20";


$result4 = $conn->query($sql4);
$data4 = array();

if ($result4->num_rows > 0) {
   
    while ($row = $result4->fetch_assoc()) {
        $data4[] = $row;
    }
} 

$dados = array(
    'dados1' => array_reverse($data1),
    'dados2' => array_reverse($data2),
    'dados3' => array_reverse($data3),
    'dados4' => array_reverse($data4)
);

echo json_encode($dados);

$conn->close();
?>