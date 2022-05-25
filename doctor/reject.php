<?php
require_once "../admin/config.php";
$sql="DELETE FROM appointment WHERE id= ?";
if($stmt=mysqli_prepare($conn,$sql)){
    mysqli_stmt_bind_param($stmt,"i",$param_id);
    $param_id=$_GET["id"];
    if(mysqli_stmt_execute($stmt)){
        header("location:appointment.php");

    }
}

?>

<html>
<head>
    <title>Delete Form</title>
</head>
<body>

</body>
</html>


