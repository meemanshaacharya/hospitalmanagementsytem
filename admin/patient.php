<?php
include("sidebar.php");

require_once("config.php");
$sql = "SELECT * FROM patients";
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


    <form action="patient_search.php" method="post" style="text-align: right">
        <input type="text" name="search_keyword"  size="50">
        <select name="search_field" required>
            <option value="full_name" selected>Full Name</option>
            <option value="id" selected>Id</option>


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
                <th>Full Name</th>
                <th>View</th>
            </tr>
            <?php foreach ($result as $row){ ?>
                <tr>
                    <td><?php echo$row['id']?></td>
                    <td><?php echo $row['full_name']?></td>

                    <td><a style="text-decoration:none" href="view_patient.php?id=<?php echo $row["id"]?>">View</a></td>

                </tr>

            <?php } ?>
        </table>
    </body>
    </html>



