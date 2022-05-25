<?php
include("sidebar.php");
require_once("header.php");
require_once("config.php");
$sql = "SELECT * FROM doctor WHERE status='Approved' ORDER BY data_reg ASC";
$result=mysqli_query($conn,$sql)
?>

    <html>
    <head><title>Doctors</title>
        <style>

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 2px;
                height: 30px;
                width: 25px;
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
    <div class="container">
        <table border="1" class=" table-responsive">
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
                <th>   </th>
                <th>   </th>
                <th>   </th>
                <th>Edit</th>

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
                    <td><?php echo $row['date_']?> </td>
                    <td><?php echo $row['date1']?> </td>
                    <td><?php echo $row['date2']?> </td>
                    <td><?php echo $row['date3']?> </td>

                    <td><a style="text-decoration:none" href="update.php?id=<?php echo $row["id"]?>">Edit</a></td>
                    </td>
                </tr>

            <?php } ?>
        </table>
    </body>
    </html>

<?php


