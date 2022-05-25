<?php
include("header.php");
include("sidebar.php");
?>

<html>
<head>
    <style>
    </style>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<hr>


<main class="main-container" style="margin-right: auto; margin-left: 250px;">
    <div class="container px-4 py-5 " id="featured-3 ">

        <h3 class="pb-2 border-bottom" style="font-size: large; font-weight: bold" > My Dashboard:</h3>


        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">


            <br>
            <div class="feature col bg-info" style="width:250px; height:170px">
                <a href="profile.php">
                    <br>   <i class="fa fa-user" style="font-size:60px; color: white; margin-left: 20px; "> <h2>My Profile</h2>
                    </i></a>

            </div>
            <br>


            <br>
            <div class="feature col bg-warning" style="width:250px; height:170px; margin-left: 20px;">
                <br>  <a href="appointment.php"><i class="fa fa-calendar" style="font-size:30px; color:white"> <h2>Book Appointments</h2>
                </i></a>

            </div>
            <br>
            <div class="feature col bg-success" style="width:250px; height:170px;margin-left: 20px; ">
                <br> <a href="my_appointments.php"> <i class="fa fa-calendar" style="font-size:30px; color:white"> <h2>My Appointments</h2>
                    </i></a>

            </div>
        </div>
    </div>

</main>

</body>
</html>

