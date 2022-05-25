<?php
// Include config file
require_once "../admin/config.php";

if (isset($_POST["id"]) && !empty($_POST["id"])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $sql = "UPDATE appointment SET  date=? WHERE id=?";
        if ($stmt = mysqli_prepare($conn, $sql)) {

            mysqli_stmt_bind_param($stmt, "si", $param_date, $param_id);


            $param_date = $_POST['date'];
            $param_id = $_POST['id'];
        } else {
            $sql = "UPDATE appointment SET  date=? WHERE id=?";
            if ($stmt = mysqli_prepare($conn, $sql)) {


                mysqli_stmt_bind_param($stmt, "si", $param_date, $param_id);
                $param_date = $_POST['date'];
                $param_id = $_POST['id'];

            }
        }

        if (mysqli_stmt_execute($stmt)) {

            // Records updated successfully. Redirect to landing page
            header("location: my_appointments.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }


    mysqli_stmt_close($stmt);


    mysqli_close($conn);
}
else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

        $id = trim($_GET["id"]);

        $sql = "SELECT * FROM appointment WHERE id = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {

                    $row = mysqli_fetch_array($result);


                    $date=$row['date'];

                } else {

                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($conn);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
<?php include "header.php"?>
<br><br>
<div class="container">
    <h1>Edit page</h1>
    <form method="post" action="" enctype="multipart/form-data">

        <input type="date" class="form-control" name="date" value="<?php echo $date; ?>" <br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>


        <input type="submit" class="btn btn-primary" value="Update">
    </form>
</div>
</body>
</html>

