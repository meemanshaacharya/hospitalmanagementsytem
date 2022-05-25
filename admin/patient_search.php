<?php
include("sidebar.php");
require_once("header.php");
require_once "config.php";
if (isset($_POST["search_keyword"]) && isset($_POST["search_field"])) {
    $search_keyword = $_POST["search_keyword"];
    $search_field = $_POST["search_field"];
    if ($search_field == "full_name") {
        $sql = "SELECT * FROM patients WHERE full_name LIKE '%" . $search_keyword . "%'";
        $result = mysqli_query($conn, $sql);
    } else if ($search_field == "id") {
        $sql = "SELECT * FROM patients WHERE id LIKE '%" . $search_keyword . "%'";
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
                <td><?php echo $row['full_name']?></td>

                <td><a style="text-decoration:none" href="view.php?id=<?php echo $row["id"]?>">View</a></td>

            </tr>

        <?php } ?>
    </table>
</body>
</html>