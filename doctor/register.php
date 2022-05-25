<?php
require_once "../admin/config.php";

// Define variables and initialize with empty values
$first_name= $last_name = $email =$password = $confirm_password ="";
$first_name_err = $last_name_err = $email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Validate first name
    $input_first_name = trim($_POST["first_name"]);
    if (empty($input_first_name)) {
        $first_name_err = "Please enter a first name.";
        $error= "Please enter a first name.";

    } elseif (!filter_var($input_first_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $first_name_err = "Please enter a valid first name.";
        $error= "Please enter a valid first name.";

    } else {
        $first_name = $input_first_name;
    }

// Validate last name
    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Please enter a email.";
        $error="Please enter a email";
    } else {
        $email = $input_email;
    }

// Validate last name
    $input_last_name = trim($_POST["last_name"]);
    if (empty($input_last_name)) {
        $last_name_err = "Please enter a last name.";
        $error= "Please enter a last name.";
    } elseif (!filter_var($input_last_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $last_name_err = "Please enter a valid last name.";
        $error= "Please enter a valid last name.";
    } else {
        $last_name = $input_last_name;
    }
// Check for password
    if (empty(trim($_POST['password']))) {
        $error= $password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST['password'])) < 5) {
        $error= $password_err = "Password cannot be less than 5 characters";
    } else {
        $password = trim($_POST['password']);
    }

// Check for confirm password field
    if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
        $error= $password_err = "Passwords should match";
    }



    if (empty($first_name_err_err) && empty($last_name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $temp_name=$_FILES['image']['tmp_name'];
        $filename=$_FILES['image']['name'];
        $folder = "upload/".$filename;
        if (move_uploaded_file($temp_name, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
        }


        $sql = "INSERT INTO doctor (first_name, last_name, email, image, qualification,  specialist, cv, exp_year,status,data_reg,password ) VALUES (?, ?, ?, ?,?,?,?,?,?,?,?)";


        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssss", $first_name, $last_name, $email, $filename, $qualification, $specialist,  $cv, $exp_year,$status,$data_reg, $param_password);

            // Set parameters
            $first_name = trim($_POST['first_name']);
            $last_name = trim($_POST['last_name']);
            $email = trim($_POST['email']);
            $filename=$_FILES['image']['name'];
            $qualification = trim($_POST['qualification']);
            $specialist = trim($_POST['specialist']);
            $cv=$_FILES['cv']['name'];
            $exp_year=trim($_POST['exp_year']);
            $status="Pending";
            $data_reg=date("F d, Y") ;
            $param_password = password_hash($password, PASSWORD_DEFAULT);


            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
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
}
?>
<html>
<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>
<form action="register.php" method="post" enctype="multipart/form-data">
    <section class="vh-100" style="background-color: #2779e2;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-9">


                    <h1 class="text-white mb-4">Apply for a job</h1>


                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body">
                            <h7 class="blockquote text-center">*All fields are required to fill!!!</h7>

                            <div class="row align-items-center pt-4 pb-3">
                                <div class="col-md-3 ps-5">
                                    <?php if (isset($_GET['error'])) { ?>

                                        <p class="error"><?php echo $_GET['error']; ?></p>

                                    <?php } ?>
                                    <h6 class="mb-0">First name</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input type="text" class="form-control form-control-lg" id="first_name" name="first_name" required/>

                                </div>
                            </div>
                            <hr class="mx-n3">
                            <div class="row align-items-center pt-4 pb-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Last name</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input type="text" class="form-control form-control-lg" id="last_name" name="last_name" required/>

                                </div>
                            </div>


                            <hr class="mx-n3">

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Email address</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input type="email" class="form-control form-control-lg" placeholder="example@example.com" id="email" name="email" required/>

                                </div>
                            </div>
                            <hr class="mx-n3">
                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Specialists:</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input type="text" class="form-control form-control-lg"  id="specialist" name="specialist" required/>

                                </div>

                            </div>
                            <hr class="mx-n3">
                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Qualification</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input type="text" class="form-control form-control-lg"  id="qualification" name="qualification" required/>

                                </div>

                            </div>
                            <hr class="mx-n3">
                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Experienced year:</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input type="number" class="form-control form-control-lg"  id="exp_year" name="exp_year" required/>

                                </div>

                            </div>
                            <hr class="mx-n3">

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Upload CV</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input class="form-control form-control-lg" id="cv" name="cv" type="file"  required/>
                                    <div class="small text-muted mt-2">Upload your CV/Resume or any other relevant file. Max file size 50 MB</div>

                                </div>
                            </div>
                            <hr class="mx-n3">

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Upload your image</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input class="form-control form-control-lg" id="image" name="image" type="file" required />
                                    <div class="small text-muted mt-2"></div>

                                </div>
                            </div>
                            <hr class="mx-n3">

                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">Password:</h6>
                                </div>
                            <div class="col-md-9 pe-5">
                                    <div class="row" style="margin-left: 150px; width:100%;">
                                        <div class="col-lg">
                                            <input class="form-control form-control-lg"  id="password" name="password" type="password"  placeholder="Enter Password" required/>
                                        </div>
                                        <div class="col-lg">
                                            <input class="form-control form-control-lg"   id="confirm_password" name="confirm_password" type="password" placeholder="Confirm Your Password" required/>
                                        </div>

                                        <div class="container">
                                            <br>

                                        </div>
                            <hr class="mx-n3">

                            <div class="px-5 py-4" >
                                <button type="submit" class="btn btn-primary btn-lg" >Send application</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</form>
</body>
</html>
