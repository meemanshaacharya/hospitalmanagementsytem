<?php

include("sidebar.php");
require_once("config.php");
?>

<html>
<head><title>My Appointments</title>
    <style>

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 4px;
        }
        tr:nth-child(even) {
            background-color: #dddddd;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            margin-left: auto;
            margin-right: auto;

        }

        a, a:hover, a:focus, a:active {
            text-decoration: none;
            color: inherit;
        }

    </style>
</head>
<body>
<br>
<br>
<br>
<h3 style="text-align: center; font-weight: bold; ">View your Appointments</h3><br>


<form action="appointment_search.php" method="post" style="text-align: right">
    <input type="text" name="search_keyword"  size="50">
    <select name="search_field" required>
        <option value="id" selected>Appointment Id</option>
        <option value="doctor_id" selected>Doctor Id</option>
        <option value="patient_id">Patient Id</option>

    </select>
    <button type="search" class="btn btn-primary" value="search">
        <i class="fas fa-search"></i>
    </button>
</form>
<br>

<?php
$sql="SELECT * FROM appointment;";
$result=mysqli_query($conn,$sql);
$rowcount=mysqli_num_rows($result);
for($i=1;$i<=$rowcount;$i++)
{
    $row=mysqli_fetch_array($result);
}
?>


<table class="table-bordered" style="margin-left: auto; margin-right: auto;">

    <tr>

        <th>Appointment Id</th>
        <th>Appointment Date</th>
        <th>Patient ID</th>
        <th>Doctor ID</th>
        <th>Edit Appointment</th>
    </tr>
    <?php foreach ($result as $row){ ?>
        <tr>
            <td><?php  echo $row['id']?></td>
            <td><?php  echo $row['date']?></td>
            <td><a href="view_patient.php? id=<?php  echo $row['patient_id']?>"><?php  echo $row['patient_id']?></a></td>
            <td><a href="view_doctor.php? id=<?php  echo $row['doctor_id']?>"><?php  echo $row['doctor_id']?></a></td>
            <td><button class="btn btn-success" type="submit"><a href="appointment_edit.php? id=<?php echo $row["id"]?>">Edit</a></button></td>
        </tr>
    <?php }?>
</table>


</body>
</html>



