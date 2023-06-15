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
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
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
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        
        <?php include ("sliderbar.php"); ?>


            <!-- Chart Start -->
            <div class="container-fluid pt-4 px-4">

                <div class="row g-4">

                    <div class="col-sm-12 col-xl-6">

                        <div class="bg-light rounded h-100 p-4">
                            
                            <canvas id="chart1"></canvas>
                            <canvas id="chart2"></canvas>
                            <canvas id="chart3"></canvas>


                        <script>
                            // Obtém os dados do arquivo PHP
                            fetch('getdata.php')
                                .then(response => response.json())
                                .then(data => {
                                    // Dados para o primeiro gráfico
                                    const dataChart1 = data.dados1;
                                    const labels = dataChart1.map(item => item.read_timestamp);
                                    const values = dataChart1.map(item => item.sensor_read);

                                    // Cria o primeiro gráfico usando Chart.js
                                    const ctx1 = document.getElementById('chart1').getContext('2d');
                                    const chart1 = new Chart(ctx1, {
                                        type: 'line',
                                                data: {
                                                    labels: labels,
                                                    datasets: [{
                                                    label: 'Soil moisture sensor',
                                                    data: values,
                                                    fill: false,
                                                    borderColor: 'rgba(0, 156, 255, .9)',
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
                                                        text: ''
                                                    }
                                                },
                                                    y: {
                                                        display: true,
                                                        title: {
                                                        display: true,
                                                        text: 'Read'
                                                    }
                                                }
                                            }
                                        }
                                    });


                                    const dataChart2 = data.dados2;
                                    const labels2 = dataChart2.map(item => item.read_timestamp);
                                    const values2 = dataChart2.map(item => item.sensor_read);

                                    // Cria o primeiro gráfico usando Chart.js
                                    const ctx2 = document.getElementById('chart2').getContext('2d');
                                    const chart2 = new Chart(ctx2, {
                                        type: 'line',
                                                data: {
                                                    labels: labels2,
                                                    datasets: [{
                                                    label: 'Air humidity sensor',
                                                    data: values2,
                                                    fill: false,
                                                    borderColor: 'rgba(255, 0, 0, .9)',
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
                                                        text: ''
                                                    }
                                                },
                                                    y: {
                                                        display: true,
                                                        title: {
                                                        display: true,
                                                        text: 'Read'
                                                    }
                                                }
                                            }
                                        }
                                    });

                                    const dataChart3 = data.dados3;
                                    const labels3 = dataChart3.map(item => item.read_timestamp);
                                    const values3 = dataChart3.map(item => item.sensor_read);

                                    // Cria o primeiro gráfico usando Chart.js
                                    const ctx3 = document.getElementById('chart3').getContext('2d');
                                    const chart3 = new Chart(ctx3, {
                                        type: 'line',
                                                data: {
                                                    labels: labels3,
                                                    datasets: [{
                                                    label: 'Temperature sensor',
                                                    data: values3,
                                                    fill: false,
                                                    borderColor: 'rgba(28, 184, 23, .9)',
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
                                                        text: ''
                                                    }
                                                },
                                                    y: {
                                                        display: true,
                                                        title: {
                                                        display: true,
                                                        text: 'Read'
                                                    }
                                                }
                                            }
                                        }
                                    });

                                })
                                .catch(error => {
                                    console.error('Erro:', error);
                                });
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
                                    $sql_data = "SELECT sensor_read_id, sensor_description, sensor_read,TIME_FORMAT(sensor_read_timestamp, '%T')  AS read_timestamp FROM sensors_read INNER JOIN sensors ON sensor_sensors_id = sensor_id  ORDER BY sensor_read_id DESC LIMIT 10";
                                    $result_select_data = $conn->query($sql_data);

                                    while($row_select_data = $result_select_data->fetch_assoc())
                                    {
                                    echo "
                                    <tr>
                                        <th scope='row'>". $row_select_data['sensor_read_id'] ."</th>
                                        <td>".$row_select_data['sensor_description']."</td>
                                        <td>".$row_select_data['sensor_read']."</td>
                                        <td>".$row_select_data['read_timestamp']."</td>
                                    </tr>";
                                    }   
                                    ?>
                                </tbody>
                            </table>
                            <div class="border rounded p-4 pb-0 mb-4">
                                <figure>
                                    <?php
                                    $sql_dark = "SELECT sensor_read, TIME_FORMAT(sensor_read_timestamp, '%T')  AS read_timestamp FROM sensors_read WHERE sensor_sensors_id = 4 ORDER BY sensor_read_id DESC LIMIT 1";

                                     $result_select_dark = $conn->query($sql_dark);

                                    while($row_select_dark = $result_select_dark->fetch_assoc())
                                    {

                                    echo "<blockquote class='blockquote'>";
                                    echo $row_select_dark['sensor_read'] == 1 ? 
                                        "<p>It's dark now! </p>" : 
                                        "<p>It's clear now! </p>";
                                    echo "</blockquote>";
                                    
                                    echo "<figcaption class='blockquote-footer'>";
                                    echo "Timestamps:". $row_select_dark['read_timestamp']; 
                                        
                                   echo " </figcaption>";
                                    }
                                    ?>
                                </figure>
                            </div>
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