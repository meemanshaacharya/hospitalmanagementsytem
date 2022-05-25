<?php
include("header.php");
include("sidebar.php");
require_once("../admin/config.php");

$sql = "SELECT * FROM doctor";
$result=mysqli_query($conn,$sql);
$rowcount=mysqli_num_rows($result);

for ($i = 1; $i <= $rowcount; $i++) {
    $row = mysqli_fetch_array($result);
}
$id = $row['id'];
?>

<html>
<head>

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<hr>
<main class="main-container" style="margin-left: 200px; margin-right: auto;"  >
    <div class="container px-4 py-5 " id="featured-3 ">

        <h3 class="pb-2 border-bottom" style="font-size: large; font-weight: bold" > Doctor Dashboard:</h3>


        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">


            <br>
            <div class="feature col bg-info" style="width:250px; height:170px">
                <a href="profile.php">
                <br>  <i class="fa fa-user-md"  style="font-size:60px; color: white "> <h2>My Profile</h2>
                </i></a>

            </div>
            <br>

            <br>
            <div class="feature col bg-warning" style="width:250px; height:170px; margin-left: 10px;">
                <br>  <a href="appointment.php"><i class="fa fa-calendar" style="font-size:30px; color:white"><h2>Total Appointments</h2></i></a>
                <p style="color: white; font-size: larger; text-align: justify"><?php
                    $sql = "SELECT COUNT(*) AS total from appointment WHERE doctor_id='$id' ";
                    $result = $conn->query($sql);
                    $data =  $result->fetch_assoc();
                    echo $data['total'];
                    ?></p >
            </div>
            <br>

        </div>
    </div>


</main>

</body>
</html>

