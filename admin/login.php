<?php
//This script will handle login
session_start();
//include "../header.php";
// check if the user is already logged in
if(isset($_SESSION['username']))
{
    header("location: welcome.php");
    exit;
}
require_once "config.php";
$username = $password = "";
$err = "";
// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username and password";

    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

    }


    if(empty($err))
    {
        $sql = "SELECT id, username, password FROM admindb WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
       // print_r($stmt);
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;

        // Try to execute this statement
        if(mysqli_stmt_execute($stmt)){

            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1)
            {

                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                if(mysqli_stmt_fetch($stmt))
                {

                    if(password_verify($password, $hashed_password))
                    {

                        // this means the password is correct. Allow user to login
                        session_start();
                        $_SESSION["username"] = $username;
                        $_SESSION["id"] = $id;
                        $_SESSION["loggedin"] = true;
                        //Redirect user to welcome page
                        header("location: welcome.php");
                    }
                }

            }

        }
    }


}


?>

<!doctype html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <title>Admin</title>
</head>
<body>

<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
                <br><br> <h4>Admin Login:</h4>
                <img src="admin.jpg"
                     class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <form action="" method="post">
                    <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                        <h4>Sign in with</h4><br><br><br>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="text" name="username" id="username" placeholder="Enter Username" class="form-control form-control-lg">

                    </div>
                    <div class="form-outline mb-3">
                        <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control form-control-lg">
                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>

                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
</body>
</html>