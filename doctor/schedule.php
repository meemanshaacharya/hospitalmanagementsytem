<?php
session_start();
?>

<?php
require_once "../config.php";

$sql = "SELECT * FROM doctor";
$result=mysqli_query($conn,$sql);
$rowcount=mysqli_num_rows($result);
for($i=1;$i<=$rowcount;$i++)
{
    $row=mysqli_fetch_array($result);
}
$id=$row['id'];
echo $id;

$new_date = date('Y-m-d', strtotime($_POST['dateFrom']));


?>




