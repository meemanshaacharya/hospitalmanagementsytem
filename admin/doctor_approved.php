<?php
require_once("config.php");

$id=$_GET["id"];
$sql="UPDATE doctor SET status='Approved' WHERE id='$id'";
mysqli_query($conn,$sql);
if(mysqli_query($conn,$sql)){
    header("location:job_approval.php");

}
?>
