<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta http-equiv="refresh" content="10">
    


    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="css/fonts.css" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <script src="js/graphs.js"></script>

</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        
        <?php include ("sliderbar.php"); //<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>?>


            <!-- Chart Start -->
            <div class="container-fluid pt-4 px-4">

                <div class="row g-4">

                    <div class="col-sm-12 col-xl-6">

                        <div class="bg-light rounded h-100 p-4">
                            
                            <canvas id="chart1"></canvas>
                            <canvas id="chart2"></canvas>
                            <canvas id="chart3"></canvas>
                            <canvas id="chart4"></canvas>

                        <script>
                            
                            function createChart(elementId, title, labels, data, borderColor, xText, yText){
                                var ctx = document.getElementById(elementId).getContext('2d');
                                var chart = new Chart(ctx, {
                                     type: 'line',
                                                data: {
                                                    labels: labels,
                                                    datasets: [{
                                                    label: title,
                                                    data: data,
                                                    fill: false,
                                                    borderColor: borderColor,
                                                    tension: 0.1
                                                    }]
                                                },
                                                 options: {
                                                    responsive: true,
                                                    scales: {
                                                    x: {
                                                        display: true,
                                                        title: {
                                                        display: true,
                                                        text: xText
                                                    }
                                                },
                                                    y: {
                                                        display: true,
                                                        title: {
                                                        display: true,
                                                        text: yText
                                                    }
                                                }
                                            }
                                        }
                                    });
                            }
                            //AJAX

                            var xhr = new XMLHttpRequest();
                            xhr.open('GET', 'getdata.php', true);
                            xhr.onload = function(){
                                if(xhr.status == 200){
                                    var data = JSON.parse(xhr.responseText);

                                    var chart1Data = data.chart1;
                                    createChart('chart1', chart1Data.title,chart1Data.labels, chart1Data.values, chart1Data.borderColor, chart1Data.xText, chart1Data.yText);


                                    var chart2Data = data.chart2;
                                    createChart('chart2', chart2Data.title,chart2Data.labels, chart2Data.values, chart2Data.borderColor, chart2Data.xText, chart2Data.yText);

                                    var chart3Data = data.chart3;
                                    createChart('chart3', chart3Data.title,chart3Data.labels, chart3Data.values, chart3Data.borderColor, chart3Data.xText, chart3Data.yText);

                                    var chart4Data = data.chart4;
                                    createChart('chart4', chart4Data.title,chart4Data.labels, chart4Data.values, chart4Data.borderColor, chart4Data.xText, chart4Data.yText);


                                     
                                }
                            };
                            xhr.send();
                        </script>

                        </div>
                    </div>


                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Last readings</h6>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Sensor Name</th>
                                        <th scope="col">Sensor reading</th>
                                        <th scope="col">Timestamps</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include("db_connection.php");
                                    $sql_data = "SELECT sensor_read_id, sensor_description, sensor_read,TIME_FORMAT(sensor_read_timestamp, '%T')  AS read_timestamp FROM sensors_read INNER JOIN sensors ON sensor_sensors_id = sensor_id  ORDER BY sensor_read_id DESC LIMIT 20";
                                    $result_select_data = $conn->query($sql_data);

                                    while($row_select_data = $result_select_data->fetch_assoc())
                                    {
                                    echo "
                                    <tr>
                                        <th scope='row'>". $row_select_data['sensor_read_id'] ."</th>
                                        <td >".$row_select_data['sensor_description']."</td>
                                        <td>".$row_select_data['sensor_read']."</td>
                                        <td>".$row_select_data['read_timestamp']."</td>
                                    </tr>";
                                    }   
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                   


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>