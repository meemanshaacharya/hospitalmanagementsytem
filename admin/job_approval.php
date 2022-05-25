<?php
include("sidebar.php");

require_once("config.php");
$sql = "SELECT * FROM doctor";
$result=mysqli_query($conn,$sql)
?>

<html>
<head><title>Doctors</title>
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
        margin-right: auto;
        margin-left: auto

    }

     .button, .button1 {
         background-color: #4CAF50;
         border: none;
         color: white;
         text-align: center;
         text-decoration: none;
         display: inline-block;
         font-size: 16px;
         margin: 4px 2px;
         cursor: pointer;
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
<h4 style="text-align: center; font-weight: bold; ">Job Requests</h4><br>
<form action="job_request_search.php" method="post" style="text-align: right">
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
<div class="container">
<table border="1" class=" table-responsive" style="margin-right: auto; margin-left: 120px;" >
    <tr>

        <th>Image</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Qualification</th>
        <th>Specialist</th>
        <th>Experienced Year</th>
        <th>CV</th>
        <th>Edit</th>
        <th>Action</th>
    </tr>
    <?php foreach ($result as $row){ ?>
        <tr>
            <td><?php echo$row['id']?></td>
            <td><img src="../doctor/upload/<?php echo $row['image']?>" height= "100%" width="100%"></td>
            <td><?php echo $row['first_name']?></td>
            <td><?php echo $row['last_name']?></td>
            <td><?php echo $row['email']?></td>
            <td><?php echo $row['qualification']?></td>
            <td><?php echo $row['specialist']?></td>
            <td><?php echo $row['exp_year']?> </td>
            <td><file src="upload/<?php echo $row['cv']?>" height= "100%" width="100%"</td>
            <td><a style="text-decoration:none" href="update_details.php?id=<?php echo $row["id"]?>">Edit</a></td>
            <td><button class="button"><a href="delete.php? id=<?php echo $row["id"]?>">Reject</a></button>
                <button class="button" style="background-color: #f44336;"><a href="doctor_approved.php? id=<?php echo $row["id"]?>">Approve</a></button>
               </td>
        </tr>

    <?php } ?>
</table>
</body>
</html>

<?php

