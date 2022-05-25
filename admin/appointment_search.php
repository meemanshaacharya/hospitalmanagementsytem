<?php
include("sidebar.php");
require_once("header.php");
require_once "config.php";
if (isset($_POST["search_keyword"]) && isset($_POST["search_field"])) {
    $search_keyword = $_POST["search_keyword"];
    $search_field = $_POST["search_field"];
    if ($search_field == "id") {
        $sql = "SELECT * FROM appointment WHERE id LIKE '%" . $search_keyword . "%'";
        $result = mysqli_query($conn, $sql);
    } else if ($search_field == "doctor_id") {
        $sql = "SELECT * FROM appointment WHERE doctor_id LIKE '%" . $search_keyword . "%'";
        $result = mysqli_query($conn, $sql);
    }
    else if ($search_field == "patient_id") {
        $sql = "SELECT * FROM appointment WHERE patient_id LIKE '%" . $search_keyword . "%'";
        $result = mysqli_query($conn, $sql);
    }
}
?>
<html>
<head><title>View Your Appointments</title>
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
        <option value="doctor_id" selected>doctor_id</option>
        <option value="patient_id" selected>patient_id</option>

    </select>
    <button type="search" class="btn btn-primary" value="search">
        <i class="fas fa-search"></i>
    </button>
</form>
<br>
<div class="container">
    <table border="1" class="table-responsive" style="margin-left: auto; margin-right: auto;">>
        <tr>
            <th>Appointment Id</th>
            <th>Appointment Date</th>
            <th>Patient ID</th>
            <th>Doctor ID</th>
        </tr>
        <?php
        if(isset($result)){
            if(mysqli_num_rows($result)==0){
                echo "<tr>";
                echo "<td colspan= '7'> No data found!!!</td> ";
                echo "</tr>";
            }
        }
        ?>
        <?php foreach ($result as $row){ ?>
            <tr>
                <td><?php  echo $row['id']?></td>
                <td><?php  echo $row['date']?></td>
                <td><a href="view_patient.php? id=<?php  echo $row['patient_id']?>"><?php  echo $row['patient_id']?></a></td>
                <td><a href="view_doctor.php? id=<?php  echo $row['doctor_id']?>"><?php  echo $row['doctor_id']?></a></td>
            </tr>

        <?php } ?>
    </table>
</body>
</html>
