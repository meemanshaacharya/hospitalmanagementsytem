<?php
include("sidebar.php");
include("header.php");
require_once("../admin/config.php");
$param_id=$_GET["id"];
$sql = "SELECT * FROM doctor WHERE id='$param_id'";
$result=mysqli_query($conn,$sql);
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $sql="INSERT INTO appointment(date, doctor_id, patient_id) VALUES (?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sii", $date, $doctor_id, $patient_id);

        $date=$_POST['date'];
        $patient_id=$_POST['user_id'];
        $doctor_id=$_POST['doctor_id'];
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
           //header("location: my_appointments.php");
            echo '<script>
alert("appointment made successfully!")
</script>';
        } else {
            echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);

        }
    } else {
        echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
    }

// Close statement
    mysqli_stmt_close($stmt);

// Close connection
    mysqli_close($conn);


}
?>

<?php foreach ($result as $row){ ?>
    <div class="card" style="margin-top:100px; margin-right: auto; margin-left: 200px; width:800px;">
        <div class="row">
            <div class="col-lg"><br>
                <img src="../doctor/upload/<?php echo $row['image']?>" height= "150px" width="150px" style="margin-left: 50px; margin-bottom: 50px;">
            </div>
            <div class="col-lg"><br>
                <label>Id:  <?php echo $row['id']?>
                </label><br>
                <label>Name:   <?php echo $row['first_name']." ".$row['last_name']?></label><br>
                <label>Email:   <?php echo $row['email']?></label><br>
                <label>Specialist:   <?php echo $row['specialist']?></label><br>
                <label>Qualification:   <?php echo $row['qualification']?></label><br>
                <label>Experienced Year:   <?php echo $row['exp_year']?></label><br>
                <label>Available date: <?php echo $row['date_']." ,".
                        $row['date1']." ,". $row['date2']." ,". $row['date3']?></label><br>

            </div>

        </div>
    </div>
    <br>
<?php } ?>

<form method="post" action="" style="margin-left: 200px;">
    <label>Doctor Id</label>
    <input type="number" name="doctor_id" class="form-control" style="width:200px;" value="<?php echo $row['id']?>"
    <label>Your Id:</label>
    <input type="number" name="user_id" class="form-control" style="width:200px;">
    <label>Appointment Date:</label>
    <input type="date" id="date" class="form-control" name="date"  style="width:200px;" value="<?php date("mm/yyyy/dd");?>">
<br>
<button class="btn btn-primary" type="submit">Submit</button>
</form>
