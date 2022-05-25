<?php
require_once("config.php");
include("sidebar.php");
include("header.php");
$id=$_GET["id"];

$sql = "SELECT * FROM patients WHERE id='$id'";
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
            width:  300px;
            height: 300px;
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
?>
<h4 style="text-align: center;">Detail Information of  <?php echo $row['full_name']."!"; ?></h4>

<div class="card">
    <table style="margin-top: 10px; margin-left: 20px; margin-right: 30px;">
        <br>
        <tr>
            <td>id</td>
            <td><?php echo $row['id']; ?></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><?php echo $row['full_name']; ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php echo $row['email']?></td>
        </tr>
        <tr>
            <td>Age</td>
            <td><?php echo $row['age']?></td>
        </tr>
        <tr>
            <td>Gender</td>
            <td><?php echo $row['gender']?></td>
        </tr>
        <tr>
            <td>Address</td>
            <td><?php echo $row['address'].", ".$row['city']?> </td>
        </tr>
        <tr>
            <td>Contact no.</td>
            <td><?php echo $row['phone']."".$row['phone']?> </td>
        </tr>

    </table>

</div>



</body>
</html>
