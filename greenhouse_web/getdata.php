<?php
include("db_connection.php");

$sql1 = "SELECT sensor_read,TIME_FORMAT(sensor_read_timestamp, '%T')  AS read_timestamp FROM sensors_read WHERE sensor_sensors_id = 1 ORDER BY sensor_read_id DESC LIMIT 5";


$result1 = $conn->query($sql1);

$chart1Labels = [];
$chart1Values = [];

if ($result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
    	$chart1Labels[] = $row["read_timestamp"];
		$chart1Values[] = (((100 - ($row["sensor_read"])/40.95)+100)%100);
    }
} 

$sql2 = "SELECT sensor_read,TIME_FORMAT(sensor_read_timestamp, '%T')  AS read_timestamp FROM sensors_read WHERE sensor_sensors_id = 2 ORDER BY sensor_read_id DESC LIMIT 5";


$result2 = $conn->query($sql2);

$chart2Labels = [];
$chart2Values = [];

if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
    	$chart2Labels[] = $row["read_timestamp"];
		$chart2Values[] = $row["sensor_read"];
    }
} 

$sql3 = "SELECT sensor_read,TIME_FORMAT(sensor_read_timestamp, '%T')  AS read_timestamp FROM sensors_read WHERE sensor_sensors_id = 3 ORDER BY sensor_read_id DESC LIMIT 5";


$result3 = $conn->query($sql3);

$chart3Labels = [];
$chart3Values = [];

if ($result3->num_rows > 0) {
    while ($row = $result3->fetch_assoc()) {
    	$chart3Labels[] = $row["read_timestamp"];
		$chart3Values[] = $row["sensor_read"];
    }
} 

$sql4 = "SELECT sensor_read,TIME_FORMAT(sensor_read_timestamp, '%T')  AS read_timestamp FROM sensors_read WHERE sensor_sensors_id = 4 ORDER BY sensor_read_id DESC LIMIT 5";


$result4 = $conn->query($sql4);

$chart4Labels = [];
$chart4Values = [];

if ($result4->num_rows > 0) {
    while ($row = $result4->fetch_assoc()) {
    	$chart4Labels[] = $row["read_timestamp"];
		$chart4Values[] = $row["sensor_read"];
    }
} 

$conn->close();

$chart1Data = array(
	'title' => 'Soil Moisture Sensor',
	'labels' => array_reverse($chart1Labels),
	'values' => array_reverse($chart1Values),
	'borderColor' => 'rgba(0, 123, 255, 1)',
	'xText' => 'Time',
	'yText' => 'Humidity (%)'
);

$chart2Data = array(
	'title' => 'Air Humidity Sensor',
	'labels' => array_reverse($chart2Labels),
	'values' => array_reverse($chart2Values),
	'borderColor' => 'rgba(106, 90, 205, 1)',
	'xText' => 'Time',
	'yText' => 'Humidity (%)'
);

$chart3Data = array(
	'title' => 'Air Temperature Sensor',
	'labels' => array_reverse($chart3Labels),
	'values' => array_reverse($chart3Values),
	'borderColor' => 'rgba(255, 165, 0, 1)',
	'xText' => 'Time',
	'yText' => 'Temperature (Cº)'
);

$chart4Data = array(
	'title' => 'LDR Sensor',
	'labels' => array_reverse($chart4Labels),
	'values' => array_reverse($chart4Values),
	'borderColor' => 'rgba(255, 0, 0, 1)',
	'xText' => 'Time',
	'yText' => 'Luminosity'
);

echo json_encode(array(
	'chart1' => $chart1Data,
	'chart2' => $chart2Data,
	'chart3' => $chart3Data,
	'chart4' => $chart4Data
));
?>