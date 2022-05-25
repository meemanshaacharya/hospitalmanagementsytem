<?php
 session_start();
require_once("../admin/config.php");
require_once("header.php");
require_once("sidebar.php");
?>

<html>
<head><title>Doctors</title>
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 65%;
            margin: auto;

            font-family: arial;
        }
        label{
            text-align: left;

        }
    </style>
</head>
<body>
<br>
<br>
<br>
<h3 style="text-align: center; font-weight: bold; ">Doctors</h3><br>


<form action="search.php" method="post" style="text-align: right">
    <input type="text" name="search_keyword"  size="50">
    <select name="search_field" required>
        <option value="first_name" selected>first_name</option>
        <option value="specialist" selected>specialist</option>
        <option value="id" selected>id</option>


    </select>
    <button type="search" class="btn btn-primary" value="search">
        <i class="fas fa-search"></i>
    </button>
</form>
<br>
<?php

$sql = "SELECT * FROM doctor WHERE status='Approved'";
$result=mysqli_query($conn,$sql)
?>

<form method="post" action=" " >
<?php foreach ($result as $row){ ?>
    <div class="card"  style="margin-top: 50px; width:60%;margin-left: auto; margin-right: auto;">
        <div class="row">
            <div class="col-lg"><br>
                <img src="../doctor/upload/<?php echo $row['image']?>" height= "150px" width="150px" style="margin-left: 50px; margin-bottom: 50px;">
            </div>
            <div class="col-lg"><br>
                <label>Id:  <?php echo $row['id']?>
                </label><br>
                <label>Name:   <?php echo $row['first_name']." ".$row['last_name']?></label><br>
                <label>Email:   <?php echo $row['email']?></label><br>
                <label>Specialist:   <?php echo $row['specialist']?></label><br>
                <label>Qualification:   <?php echo $row['qualification']?></label><br>
                <label>Experienced Year:   <?php echo $row['exp_year']?></label><br>
                <label>Available date: <?php echo $row['date_']." ,".
                        $row['date1']." ,". $row['date2']." ,". $row['date3']?></label><br>
                <button  type="submit"  class="btn btn-info"><a href="book_appointment.php? id=<?php echo $row["id"]?>">Book Appointment</a></button>

            </div>

        </div>
    </div>


</form>


</body>
</html>
<?php

}
?>

