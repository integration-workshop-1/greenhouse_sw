<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("db_connection.php"); ?>
    <meta charset="utf-8">
    <title>GREENHOUSE</title>
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

     <script src="js/graphs.js"></script>
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
          <?php include ("sliderbar.php"); ?>

        
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">                       
                    <div class="col-12">
                        <canvas id="chart1"></canvas>
                         <script>
                            // Obtém os dados do arquivo PHP
                            fetch('getdata_total.php')
                                .then(response => response.json())
                                .then(data => {

const dataChart3 = data.dados2;
                                    const labels3 = dataChart3.map(item => item.read_timestamp);
                                    const values3 = dataChart3.map(item => item.sensor_read);

                                    // Cria o primeiro gráfico usando Chart.js
                                    const ctx3 = document.getElementById('chart1').getContext('2d');
                                    const chart3 = new Chart(ctx3, {
                                        type: 'line',
                                                data: {
                                                    labels: labels3,
                                                    datasets: [{
                                                    label: 'Air temperature',
                                                    data: values3,
                                                    fill: false,
                                                    borderColor: 'rgba(255, 165, 0, 1)',
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
                                                        text: 'Time'
                                                    }
                                                },
                                                    y: {
                                                        display: true,
                                                        title: {
                                                        display: true,
                                                        text: 'Temperature (Cº)'
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
            </div>

            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">                       
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Soil Moisture Sensor</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Sensor Read</th>
                                            <th scope="col">Timestamp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                    include("db_connection.php");
                                    $sql_data = "SELECT sensor_read_id, sensor_sensors_id, sensor_read,TIME_FORMAT(sensor_read_timestamp, '%T')  AS read_timestamp FROM sensors_read WHERE sensor_sensors_id = 3 ORDER BY sensor_read_id DESC LIMIT 50";
                                    $result_select = $conn->query($sql_data);

                                    while($row_select = $result_select->fetch_assoc())
                                    {
                                        echo "
                                        <tr>
                                            <th scope='row'>". $row_select['sensor_read_id']. "</th>
                                            <td>". $row_select['sensor_read']. "</td>
                                            <td>". $row_select['read_timestamp']. "</td>
                                        </tr>
                                        ";
                                    }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->


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