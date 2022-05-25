<?php
include("header.php");
include("sidebar.php");
require_once('config.php');

?>

<html>
<head>
    <style>
        sidebar {
            float: left;
        }
        main {
            overflow: hidden;
        }
        h2{
            color:white;
        }




    </style>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<hr>



<main class="main-container" style="margin-left: 200px;">
    <div class="container px-4 py-5 " id="featured-3 ">

        <h3 class="pb-2 border-bottom" style="font-size: large; font-weight: bold" > Admin Dashboard:</h3>


        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <div class="feature col bg-success" style="width:250px; height:170px">
              <br>  <i class="fas fa-user-cog"  style="font-size:60px; color: white "> <h2>Total Admins</h2>
                </i>

                <p style="color: white; font-size: larger; text-align: justify"><?php
                    $sql = "SELECT COUNT(*) AS total from admindb";
                    $result = $conn->query($sql);
                    $data =  $result->fetch_assoc();
                    echo $data['total'];
                    ?> </p>

            </div>

           <br>
            <div class="feature col bg-primary" style="width:250px; height:170px; margin-left: 25px;">
                <br>  <a href="doctors.php"><i class="fa fa-user-md"  style="font-size:60px; color: white "> <h2>Total Doctors</h2>
                </i></a>

                <p style="color: white; font-size: larger; text-align: justify"> <?php
                    $sql = "SELECT COUNT(*) AS total from doctor WHERE status='Approved'";
                    $result = $conn->query($sql);
                    $data =  $result->fetch_assoc();
                    echo $data['total'];
                    ?></p>

            </div>

            <br>
            <div class="feature col bg-danger" style="width:250px; height:170px; margin-left: 25px;">
                <a href="patient.php">
                <br>  <i class="fa fa-wheelchair"  style="font-size:60px; color: white ; margin-left: 25px;"> <h2>Total Patients</h2>
                </i></a>

                <p style="color: white; font-size: larger; text-align: justify"> <?php
                    $sql = "SELECT COUNT(*) AS total from patients";
                    $result = $conn->query($sql);
                    $data =  $result->fetch_assoc();
                    echo $data['total'];
                    ?></p>

            </div>
            <br>
            <div class="feature col bg-warning" style="width:250px; height:170px; margin-left: 25px;">
                <br><a href="job_approval.php" > <i class="fa fa-address-card" style="font-size:40px; color:white"> <h2> Job Requests</h2>
                </i></a>

                <p style="color: white; font-size: larger; text-align: justify"> <?php
                    $sql = "SELECT COUNT(*) AS total from doctor WHERE status='Pending'";
                    $result = $conn->query($sql);
                    $data =  $result->fetch_assoc();
                    echo $data['total'];
                    ?></p>
                </p>

            </div>
            <br>
            <div class="feature col bg-danger" style="width:250px; height:170px; margin-left: 25px;">
                <br>  <a href="appointment.php"><i class="fa fa-calendar" style="font-size:30px; color:white"> <h2>Total Appointments</h2>
                </i></a>

                <p style="color: white; font-size: larger; text-align: justify"> <?php
                    $sql = "SELECT COUNT(*) AS total from appointment ";
                    $result = $conn->query($sql);
                    $data =  $result->fetch_assoc();
                    echo $data['total'];
                    ?></p>
                </p>

            </div>

        </div>
    </div>


</main>

</body>
</html>
