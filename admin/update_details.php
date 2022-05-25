<?php
// Include config file
require_once "config.php";

//Define variables and initialize with empty values
$first_name= $last_name = $email =$password = $confirm_password ="";
$first_name_err = $last_name_err = $email_err = $password_err = $confirm_password_err = "";
if (isset($_POST["id"]) && !empty($_POST["id"])) {
// Get hidden input value
    $id = $_POST["id"];
    $temp_name = $_FILES['image']['tmp_name'];
    $filename = $_FILES['image']['name'];
    $folder = "upload/" . $filename;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Validate first name
        $input_first_name = trim($_POST["first_name"]);
        if (empty($input_first_name)) {
            $first_name_err = "Please enter a first name.";
            $error = "Please enter a first name.";

        } elseif (!filter_var($input_first_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
            $first_name_err = "Please enter a valid first name.";
            $error = "Please enter a valid first name.";

        } else {
            $first_name = $input_first_name;
        }

        $input_last_name = trim($_POST["last_name"]);
        if (empty($input_last_name)) {
            $last_name_err = "Please enter a last name.";
            $error = "Please enter a last name.";
        } elseif (!filter_var($input_last_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
            $last_name_err = "Please enter a valid last name.";
            $error = "Please enter a valid last name.";
        } else {
            $last_name = $input_last_name;
        }

        $input_email = trim($_POST["email"]);
        if (empty($input_email)) {
            $email_err = "Please enter a email.";
            $error = "Please enter a email";
        } else {
            $email = $input_email;
        }


// Check input errors before inserting in database
        if (empty($first_name_err) && empty($last_name_err) && empty($email_err)) {
            // Prepare an update statement
            if ($filename == "") {
                $sql = "UPDATE doctor SET first_name=?, last_name=?, email=?, qualification=?,  specialist=?,  exp_year=? WHERE id=?";
                if ($stmt = mysqli_prepare($conn, $sql)) {
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "sssssii", $param_first_name, $param_last_name, $param_email, $param_qualification, $param_specialist, $param_exp_year, $param_id);

                    // Set parameters
                    $param_first_name = $first_name;
                    $param_last_name = $last_name;
                    $param_email = $email;
                    $param_qualification = $_POST['qualification'];
                    $param_specialist = $_POST['specialist'];
                    $param_exp_year = $_POST['exp_year'];
                    $param_id = $_POST['id'];
                }
            } else {
                $sql = "UPDATE doctor SET first_name=?, last_name=?, email=?, image=?,  qualification=?,  specialist=?,  exp_year=? WHERE id=?";
                if ($stmt = mysqli_prepare($conn, $sql)) {

                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "ssssssii", $param_first_name, $param_last_name, $param_email, $filename, $param_qualification, $param_specialist, $param_exp_year, $param_id);
                    // Set parameters
                    $param_first_name = $first_name;
                    $param_last_name = $last_name;
                    $param_email = $email;
                    $filename = $_FILES['image']['name'];
                    $param_qualification = $_POST['qualification'];
                    $param_specialist = $_POST['specialist'];
                    $param_exp_year = $_POST['exp_year'];
                    $param_id = $_POST['id'];

                }
            }
            if (move_uploaded_file($temp_name, $folder)) {
                $msg = "Image uploaded successfully";
            } else {
                $msg = "Failed to upload image";
            }
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {

                // Records updated successfully. Redirect to landing page
                header("location: job_approval.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

    }

    //mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($conn);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id = trim($_GET["id"]);
        // Prepare a select statement
        $sql = "SELECT * FROM doctor WHERE id = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result);

                    // Retrieve individual field value
                    $first_name = $row["first_name"];
                    $last_name = $row["last_name"];
                    $email = $row["email"];
                    $image = $row["image"];
                    $qualification=$row["qualification"];
                    $specialist=$row['specialist'];
                    $exp_year=$row['exp_year'];

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
        <input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>"<br><br>
        <input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>"<br><br>
        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" <br><br>
        <input type="file" class="form-control" name="image" ><br>
        <input type="text" class="form-control" name="qualification" value="<?php echo $qualification; ?>" <br><br>
        <input type="text" class="form-control" name="specialist" value="<?php echo $specialist; ?>" <br><br>
        <input type="number" class="form-control" name="exp_year" value="<?php echo $exp_year; ?>" <br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>


        <input type="submit" class="btn btn-primary" value="Update">
    </form>
</div>
</body>
</html>
