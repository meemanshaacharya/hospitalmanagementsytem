<?php
session_start();
//$id=$_SESSION['id'];
//if($_SESSION["loggedin"] = true)
//{
    //header("location: profile.php");
//}
//else{
    //header("location: login.php");
//}

?>
<?php
require_once "../admin/config.php";
include("sidebar.php");
include("header.php");
$sql = "SELECT * FROM doctor";
$result=mysqli_query($conn,$sql);
$rowcount=mysqli_num_rows($result);




?>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 65%;
            margin: auto;
            text-align: center;
            font-family: arial;
        }

        title {
            color: grey;
            font-size: 18px;
        }

        a {
            text-decoration: none;
            font-size: 22px;
            color: black;
        }

        button:hover, a:hover {
            opacity: 0.7;
        }
        img {
            width:  200px;
            height: 200px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 10px;

        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        tr, td {
            text-align: left;
            padding: 8px;
        }



    </style>
</head>
<body style="margin-top: 30px;">
<h2 style="text-align:center">MY Profile</h2>

<?php
for($i=1;$i<=$rowcount;$i++)
{
    $row=mysqli_fetch_array($result);
}
$id=$row['id'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $date = $_POST['dateFrom'];
    $date1 = $_POST['dateFrom1'];
    $date2 = $_POST['dateFrom2'];
    $date3 = $_POST['dateFrom3'];
    $sql = "UPDATE doctor SET date_='$date', date1='$date1', date2='$date2', date3='$date3' WHERE id='$id'";
    mysqli_query($conn, $sql);
}

?>
<h4 style="text-align: center;">Welcome <?php echo $row['first_name']." ". $row['last_name']."!";
?></h4>

<div class="card">
   <img src="upload/<?php echo $row['image']?>">
<table style="margin-top: 10px; margin-left: 20px; margin-right: 30px;">
    <br>
    <tr>
       <td>Schedule your <br><br> Available Time:</td>
        <td> <form action="" method="post">
                <input type="date" id="dateFrom" name="dateFrom" value="<?php date("mm/yyyy/dd");?>">
                <input type="date" id="dateFrom1" name="dateFrom1" value="<?php date("mm/yyyy/dd");?>">
                <input type="date" id="dateFrom2" name="dateFrom2" value="<?php date("mm/yyyy/dd");?>">
                <input type="date" id="dateFrom3" name="dateFrom3" value="<?php date("mm/yyyy/dd");?>">
                <br><br>
                <button class= "btn btn-success" type="submit">Schedule</a></button>


            </form></td>

    </tr>
    <tr>
        <td>Name</td>
        <td><?php echo $row['first_name']." ". $row['last_name']; ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo $row['email']?></td>
    </tr>
    <tr>
        <td>Qualification</td>
        <td><?php echo $row['qualification']?></td>
    </tr>
    <tr>
        <td>Specialist</td>
        <td><?php echo $row['specialist']?></td>
    </tr>
    <tr>
        <td>Experienced Year</td>
        <td><?php echo $row['exp_year']?> </td>
    </tr>
    <tr>
        <td>Scheduled</td>
        <td><?php echo $row['date_']." ,".
            $row['date1']." ,". $row['date2']." ,". $row['date3']?></td>
    </tr>


</table>

</div>



</body>
</html>