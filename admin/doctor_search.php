<?php
include("sidebar.php");
require_once("header.php");
require_once "config.php";
if (isset($_POST["search_keyword"]) && isset($_POST["search_field"])) {
    $search_keyword = $_POST["search_keyword"];
    $search_field = $_POST["search_field"];
    if ($search_field == "first_name") {
        $sql = "SELECT * FROM doctor WHERE full_name LIKE '%" . $search_keyword . "%' WHERE status='Approved'";
        $result = mysqli_query($conn, $sql);
    } else if ($search_field == "id") {
        $sql = "SELECT * FROM doctor WHERE id LIKE '%" . $search_keyword . "%' WHERE status='Approved'";
        $result = mysqli_query($conn, $sql);
    }
    else if ($search_field == "last_name") {
        $sql = "SELECT * FROM doctor WHERE id LIKE '%" . $search_keyword . "%' WHERE status='Approved'";
        $result = mysqli_query($conn, $sql);
    }
    else if ($search_field == "specialist") {
        $sql = "SELECT * FROM doctor WHERE id LIKE '%" . $search_keyword . "%' WHERE status='Approved'";
        $result = mysqli_query($conn, $sql);
    }
}
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
<h3 style="text-align: center; font-weight: bold; ">Patients</h3><br>


<form action="doctor_search.php" method="post" style="text-align: right">
    <input type="text" name="search_keyword"  size="50">
    <select name="search_field" required>
        <option value="first_name" selected>Full Name</option>
        <option value="id" selected>Id</option>
        <option value="last_name" selected>last name</option>

        <option value="specialist" selected>specialist</option>



    </select>
    <button type="search" class="btn btn-primary" value="search">
        <i class="fas fa-search"></i>
    </button>
</form>
<br>
<div class="container">
    <table border="1" class=" table-responsive" style="margin-left: 200px; width:60%;">
        <tr>

            <th>Id</th>
            <th>Image</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Qualification</th>
            <th>Specialist</th>
            <th>Experienced Year</th>
            <th>Schedule date</th>
            <th></th>
            <th></th>
            <th>Edit</th>
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
                <td><?php echo$row['id']?></td>
                <td><img src="upload/<?php echo $row['image']?>" height= "100%" width="100%"></td>
                <td><?php echo $row['first_name']?></td>
                <td><?php echo $row['last_name']?></td>
                <td><?php echo $row['email']?></td>
                <td><?php echo $row['qualification']?></td>
                <td><?php echo $row['specialist']?></td>
                <td><?php echo $row['exp_year']?> </td>
                <td><?php echo $row['date_']?> </td>
                <td><?php echo $row['date1']?> </td>
                <td><?php echo $row['date2']?> </td>

                <td><a style="text-decoration:none" href="update.php?id=<?php echo $row["id"]?>">Edit</a></td>
                </td>
            </tr>

        <?php } ?>
    </table>
</body>
</html>
