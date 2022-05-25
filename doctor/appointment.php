<?php
session_start();
include("sidebar.php");
include("header.php");
require_once("../admin/config.php");
$sql = "SELECT * FROM doctor";
$result=mysqli_query($conn,$sql);
$rowcount=mysqli_num_rows($result);
for($i=1;$i<=$rowcount;$i++)
{
    $row=mysqli_fetch_array($result);
}
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

<br>



<?php
$id=$row['id'];

$sql="SELECT *, A.id, P.full_name, P.email, A.patient_id, A.date
FROM patients P 
INNER JOIN  appointment A
ON  (A.patient_id=P.id) WHERE doctor_id='$id';" ;
$result=mysqli_query($conn,$sql);
$rowcount=mysqli_num_rows($result);
for($i=1;$i<=$rowcount;$i++)
{
    $row=mysqli_fetch_array($result);
}

?>

<table>

    <tr>
        <th>Appointment Id</th>
        <th>Patient </th>
        <th>age</th>
        <th>gender</th>
        <th>email</th>
        <th>date</th>
        <th>Edit</th>
        <th>Reject</th>
    </tr>
    <?php foreach ($result as $row){ ?>
        <tr>
            <td><?php  echo $row['id']?></td>
            <td><?php  echo $row['full_name']?></td>
            <td><?php  echo $row['age']?></td>
            <td><?php  echo $row['gender']?></td>
            <td><?php  echo $row['email']?></td>
            <td><?php  echo $row['date']?></td>

            <td><button class="btn btn-success" type="submit"><a href="appointment_edit.php? id=<?php echo $row["id"]?>">Edit</a></button></td>
            <td><button class="btn btn-danger" type="submit"><a href="reject.php? id=<?php echo $row["id"]?>">Reject</a></button></td>
        </tr>
    <?php }?>
</table>


</body>
</html>



