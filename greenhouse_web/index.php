<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("db_connection.php"); ?>
    <meta charset="utf-8">
    <title>GREENHOUSE</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    

                                <?php 
                                    $sql_color_button = "SELECT manual_data_connection_type FROM manual_data_modify";
                                    $result_color_button = $conn->query($sql_color_button);
                                            while($row_color_button = $result_color_button->fetch_assoc())
                                            {
                                                $type_button =  $row_color_button['manual_data_connection_type'];
                                            }
                                ?>

                      <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">System setup</h6>
                            <div class="m-n2">
                            <form action="button_manual_data_connection_type.php" method="POST">
                                <button type="submit" class="<?php if($type_button == 2) echo "btn btn-primary m-2"; else echo "btn btn-outline-primary m-2" ?>" name="manual_data" value= "2">Manual</button>
                                <button type="submit" class="<?php if($type_button == 1) echo "btn btn-primary m-2"; else echo "btn btn-outline-primary m-2" ?>" name="automatic_data" value= "1">Automatic</button>
                            </form>
                            </div>
                        </div>
                    </div>

                <?php
                $sql_manual = "SELECT plant_name, manual_data_plant_id, manual_data_temperature, manual_data_soil_moisture, manual_data_air_humidity FROM manual_data_modify  INNER JOIN plants ON manual_data_plant_id = plant_id WHERE manual_data_id = 1";
                $result_manual = $conn->query($sql_manual);

                while($row_manual = $result_manual->fetch_assoc())
                {
                    $id_manual = $row_manual['manual_data_plant_id'];
                ?>
                    <div class="col-sm-12 col-xl-6">
                       <div class="bg-light rounded h-100 p-4">
                           
                            <div class="ms-3">

                                <p class="mb-2">Plant name</p>

                                <h6 class="mb-0"><?php echo $row_manual['plant_name'];?></h6>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <!-- Sale & Revenue End -->


            <!-- Sales Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">



                            <h6 class="mb-4"><a href = "manual_data.php">Manual configurations</a></h6>
                                <table class="table table-bordered">
                                
                                <tbody>
                                    
                                    <tr>
                                        <td>Temperature</td>
                                        <td><?php echo $row_manual['manual_data_temperature'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Soil moisture</td>
                                        <td><?php echo (((100 - ($row_manual['manual_data_soil_moisture'])/40.95)+100)%100)."%";?></td>
                                    </tr>
                                    <tr>
                                        <td>Air Humidity</td>
                                        <td><?php echo $row_manual['manual_data_air_humidity'];?></td>
                                    </tr>
                                </tbody>
                            </table>

                            </div>


                        </div>

                    <?php } ?>

                   <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                        
                        <?php 
                        $sql_automatic = "SELECT * FROM plants WHERE plant_id = $id_manual";
                        
                        $result_automatic = $conn->query($sql_automatic);

                        while($row_automatic = $result_automatic->fetch_assoc())
                        {
                           
                        ?>


                            <h6 class="mb-4"><a href = "plants_update.php">Automatic configurations</a></h6>

                                <table class="table table-bordered">
                                
                                <tbody>
                                    
                                    <tr>
                                        <td>Temperature</td>
                                        <td><?php echo $row_automatic['plant_temperature'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Soil moisture</td>
                                        <td><?php echo (((100 - ($row_automatic['plant_soil_moisture'])/40.95)+100)%100)."%";?></td>
                                    </tr>
                                    <tr>
                                        <td>Air Humidity</td>
                                        <td><?php echo $row_automatic['plant_air_humidity'];?></td>
                                    </tr>
                                </tbody>
                            </table>

                            </div>
                        <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Sales Chart End -->


           


            
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

<?php $conn->close(); ?>
</html>