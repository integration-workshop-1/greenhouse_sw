<!DOCTYPE html>
<html lang="en">

<head>
    <?php
            include("db_connection.php");
    ?>

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
        <?php include("sliderbar.php"); ?>

            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">


                    <!-- Form-->
                    <center>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Plants</h6>
                            <form action="update_plant_data.php" method="POST">
                                <?php
                                            $plant_id = $_POST['plant_id'];

                                if (isset($_POST['update_button'])){
                                            $sql_select = "SELECT * FROM plants WHERE plant_id = $plant_id";
                                            $result_select = $conn->query($sql_select);
                                            while($row_select = $result_select->fetch_assoc())
                                            {
                                        ?>

                                <div class="mb-3">
                                    <input type="hidden" name="plant_id" value="<?php echo $row_select['plant_id'];?>">
                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="plant_name" value = "<?php echo $row_select['plant_name'];?>">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Temperature</label>
                                    <input type="text" class="form-control" name="plant_temperature" value = "<?php echo $row_select['plant_temperature'];?>">
                                </div>

                                <div class="mb-3">
                                    
                                    <label for="exampleInputEmail1" class="form-label">Soil Moisture</label>

                                    <input type="text" class="form-control" name="plant_soil_moisture" value = "<?php echo $row_select['plant_soil_moisture'];?>">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Air Humidity</label>
                                    <input type="text" class="form-control" name="plant_air_humidity" value = "<?php echo $row_select['plant_air_humidity'];?>">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Description</label>
                                <textarea class="form-control" placeholder=""  name="plant_description" style="height: 150px;"><?php echo $row_select['plant_description'];?></textarea>
                                
                            </div>
                                <div class="mb-3">
                                        <button type="submit" class="btn btn-lg btn-primary m-2" name="plant_update_button">Update data</button>
                                </div>

                            </form>
                            
                        </div>
                    </div>  
               

                   
                        
                            
                          
                            <?php } }
                            else
                            {
                                $sql_delete = "DELETE FROM plants WHERE plant_id = $plant_id";
                                    if ($conn->query($sql_delete) === TRUE)
                                    {
                                       echo "<script type = 'text/javascript'> 
                                                alert('Successfully data deleted!');
                                                javascript:window.location='plants_update.php';
                                            </script>";  
                                    }
                                    else{
                                        echo "<script type = 'text/javascript'> 
                                                alert('Error deleting record');
                                                javascript:window.location='plants_update.php';
                                            </script>";  
                                        
                                    }
                            } ?>
        
                    
                </div>
            </div>
            <!-- Form End -->


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

<?php $conn->close(); ?>

</html>